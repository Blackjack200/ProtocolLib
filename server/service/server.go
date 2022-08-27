package service

import (
	"context"
	"fmt"
	"github.com/blackjack200/protocol-lib/proto"
	"github.com/sirupsen/logrus"
	"google.golang.org/protobuf/types/known/emptypb"
	"sync"
)

type nodeSession struct {
	serverType string
	info       *proto.NodeInfo
}

type Tracker struct {
	proto.UnimplementedTrackerServer
	mu       sync.Mutex
	sessions map[string]nodeSession
}

func NewTracker() *Tracker {
	return &Tracker{
		UnimplementedTrackerServer: proto.UnimplementedTrackerServer{},
		mu:                         sync.Mutex{},
		sessions:                   make(map[string]nodeSession),
	}
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
		serverType: request.Type,
		info:       request.Info,
	}
	return &proto.LoginResponse{
		Status: proto.LoginStatusCode_SUCCESS,
	}, nil
}

func (t *Tracker) GetAllPerformanceInfo(_ context.Context, _ *emptypb.Empty) (*proto.PerformanceInfoResponse, error) {
	info := make(map[string]*proto.NodePerformanceInfo, len(t.sessions))
	for nodeId, session := range t.sessions {
		info[nodeId] = session.info.PerformanceInfo
	}
	return &proto.PerformanceInfoResponse{
		Info: info,
	}, nil
}

func (t *Tracker) Heartbeat(_ context.Context, info *proto.NodeInfo) (*proto.HeartbeatResponse, error) {
	if s, ok := t.sessions[info.NodeId]; ok {
		s.info = info
		logrus.Infof("heartbeat id=%v", info.NodeId)
		return nil, nil
	}
	return nil, fmt.Errorf("node %v not founded", info.NodeId)
}

func (t *Tracker) Select(_ context.Context, req *proto.SelectServerRequest) (*proto.SelectServerResponse, error) {
	for nodeId, session := range t.sessions {
		if req.RequestedYpe == session.serverType && session.info.CanJoin {
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
	logrus.Infof("quit id=%v", request.NodeId)
	delete(t.sessions, request.NodeId)
	return &emptypb.Empty{}, nil
}

var _ proto.TrackerServer = &Tracker{}
