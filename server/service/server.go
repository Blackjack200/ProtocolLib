package service

import (
	"context"
	"fmt"
	"github.com/blackjack200/protocol-lib/proto"
	"github.com/sirupsen/logrus"
	"google.golang.org/protobuf/types/known/emptypb"
	"sync"
	"sync/atomic"
	"time"
)

type nodeSession struct {
	ServerType string
	Info       *proto.NodeInfo
	LastActive time.Time
}

type Tracker struct {
	proto.UnimplementedTrackerServer
	mu               sync.RWMutex
	running          atomic.Bool
	sessions         map[string]nodeSession
	pendingBroadcast map[string][]*proto.BroadcastMessage
	file             string
}

func NewTracker(file string) *Tracker {
	tr := &Tracker{
		UnimplementedTrackerServer: proto.UnimplementedTrackerServer{},
		mu:                         sync.RWMutex{},
		running:                    atomic.Bool{},
		sessions:                   make(map[string]nodeSession),
		pendingBroadcast:           make(map[string][]*proto.BroadcastMessage),
		file:                       file,
	}
	tr.running.Store(true)
	t := time.NewTicker(time.Second / 20)
	go func() {
		for tr.running.Load() {
			select {
			case _ = <-t.C:
				tr.removeTimeoutClient()
			}
		}
		t.Stop()
	}()
	return tr
}

func (t *Tracker) Login(_ context.Context, request *proto.LoginRequest) (*proto.LoginResponse, error) {
	t.mu.Lock()
	defer t.mu.Unlock()
	if _, ok := t.sessions[request.NodeId]; ok {
		return &proto.LoginResponse{
			Status: proto.LoginStatusCode_FAILED,
		}, nil
	}
	logrus.Infof("connected id=%v type=%v", request.NodeId, request.Type)
	t.sessions[request.NodeId] = nodeSession{
		ServerType: request.Type,
		Info:       request.Info,
		LastActive: time.Now(),
	}
	t.pendingBroadcast[request.NodeId] = nil
	return &proto.LoginResponse{
		Status: proto.LoginStatusCode_SUCCESS,
	}, nil
}

func (t *Tracker) GetAllPerformanceInfo(_ context.Context, _ *emptypb.Empty) (*proto.PerformanceInfoResponse, error) {
	t.mu.RLock()
	defer t.mu.RUnlock()
	info := make(map[string]*proto.NodePerformanceInfo, len(t.sessions))
	for nodeId, session := range t.sessions {
		info[nodeId] = session.Info.PerformanceInfo
	}
	return &proto.PerformanceInfoResponse{
		Info: info,
	}, nil
}

func (t *Tracker) Heartbeat(_ context.Context, info *proto.NodeInfo) (*proto.HeartbeatResponse, error) {
	t.mu.Lock()
	defer t.mu.Unlock()
	if s, ok := t.sessions[info.NodeId]; ok {
		s.Info = info
		s.LastActive = time.Now()
		logrus.Infof("heartbeat id=%v", info.NodeId)
		old := t.pendingBroadcast[info.NodeId]
		t.pendingBroadcast[info.NodeId] = nil
		return &proto.HeartbeatResponse{Msg: old}, nil
	}
	return nil, fmt.Errorf("node %v not founded", info.NodeId)
}

func (t *Tracker) Select(_ context.Context, req *proto.SelectServerRequest) (*proto.SelectServerResponse, error) {
	t.mu.RLock()
	defer t.mu.RUnlock()
	for nodeId, session := range t.sessions {
		if req.RequestedYpe == session.ServerType && session.Info.CanJoin {
			return &proto.SelectServerResponse{
				TargetNodeId: &nodeId,
			}, nil
		}
	}
	return &proto.SelectServerResponse{TargetNodeId: nil}, nil
}

func (t *Tracker) Quit(_ context.Context, request *proto.QuitRequest) (*emptypb.Empty, error) {
	t.mu.Lock()
	defer t.mu.Unlock()
	t.quitNoLock(request.NodeId)
	return &emptypb.Empty{}, nil
}

func (t *Tracker) Broadcast(_ context.Context, msg *proto.BroadcastMessage) (*emptypb.Empty, error) {
	t.mu.Lock()
	defer t.mu.Unlock()
	for id := range t.pendingBroadcast {
		t.pendingBroadcast[id] = append(t.pendingBroadcast[id], msg)
	}
	return &emptypb.Empty{}, nil
}

func (t *Tracker) quitNoLock(nodeId string) {
	logrus.Infof("quit id=%v", nodeId)
	delete(t.sessions, nodeId)
	delete(t.pendingBroadcast, nodeId)
}

func (t *Tracker) removeTimeoutClient() {
	t.mu.Lock()
	defer t.mu.Unlock()
	for nodeId, session := range t.sessions {
		if time.Now().Sub(session.LastActive).Seconds() >= 5 {
			t.quitNoLock(nodeId)
		}
	}
}

var _ proto.TrackerServer = &Tracker{}

func (t *Tracker) Close() {
	t.running.Store(false)
}
