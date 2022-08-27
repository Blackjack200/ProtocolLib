// Code generated by protoc-gen-go. DO NOT EDIT.
// versions:
// 	protoc-gen-go v1.28.1
// 	protoc        v3.21.5
// source: proto/define.proto

package proto

import (
	protoreflect "google.golang.org/protobuf/reflect/protoreflect"
	protoimpl "google.golang.org/protobuf/runtime/protoimpl"
	reflect "reflect"
	sync "sync"
)

const (
	// Verify that this generated code is sufficiently up-to-date.
	_ = protoimpl.EnforceVersion(20 - protoimpl.MinVersion)
	// Verify that runtime/protoimpl is sufficiently up-to-date.
	_ = protoimpl.EnforceVersion(protoimpl.MaxVersion - 20)
)

type LoginStatusCode int32

const (
	LoginStatusCode_SUCCESS LoginStatusCode = 0
	LoginStatusCode_FAILED  LoginStatusCode = 1
)

// Enum value maps for LoginStatusCode.
var (
	LoginStatusCode_name = map[int32]string{
		0: "SUCCESS",
		1: "FAILED",
	}
	LoginStatusCode_value = map[string]int32{
		"SUCCESS": 0,
		"FAILED":  1,
	}
)

func (x LoginStatusCode) Enum() *LoginStatusCode {
	p := new(LoginStatusCode)
	*p = x
	return p
}

func (x LoginStatusCode) String() string {
	return protoimpl.X.EnumStringOf(x.Descriptor(), protoreflect.EnumNumber(x))
}

func (LoginStatusCode) Descriptor() protoreflect.EnumDescriptor {
	return file_proto_define_proto_enumTypes[0].Descriptor()
}

func (LoginStatusCode) Type() protoreflect.EnumType {
	return &file_proto_define_proto_enumTypes[0]
}

func (x LoginStatusCode) Number() protoreflect.EnumNumber {
	return protoreflect.EnumNumber(x)
}

// Deprecated: Use LoginStatusCode.Descriptor instead.
func (LoginStatusCode) EnumDescriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{0}
}

type NodePerformanceInfo struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	Tps        int32   `protobuf:"varint,1,opt,name=tps,proto3" json:"tps,omitempty"`
	AverageTps float32 `protobuf:"fixed32,2,opt,name=average_tps,json=averageTps,proto3" json:"average_tps,omitempty"`
}

func (x *NodePerformanceInfo) Reset() {
	*x = NodePerformanceInfo{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[0]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *NodePerformanceInfo) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*NodePerformanceInfo) ProtoMessage() {}

func (x *NodePerformanceInfo) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[0]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use NodePerformanceInfo.ProtoReflect.Descriptor instead.
func (*NodePerformanceInfo) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{0}
}

func (x *NodePerformanceInfo) GetTps() int32 {
	if x != nil {
		return x.Tps
	}
	return 0
}

func (x *NodePerformanceInfo) GetAverageTps() float32 {
	if x != nil {
		return x.AverageTps
	}
	return 0
}

type NodeInfo struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	NodeId           string               `protobuf:"bytes,1,opt,name=node_id,json=nodeId,proto3" json:"node_id,omitempty"`
	CanJoin          bool                 `protobuf:"varint,2,opt,name=canJoin,proto3" json:"canJoin,omitempty"`
	OnlinePlayers    []string             `protobuf:"bytes,3,rep,name=online_players,json=onlinePlayers,proto3" json:"online_players,omitempty"`
	MaxOnlinePlayers int32                `protobuf:"varint,4,opt,name=max_online_players,json=maxOnlinePlayers,proto3" json:"max_online_players,omitempty"`
	PerformanceInfo  *NodePerformanceInfo `protobuf:"bytes,5,opt,name=performance_info,json=performanceInfo,proto3" json:"performance_info,omitempty"`
}

func (x *NodeInfo) Reset() {
	*x = NodeInfo{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[1]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *NodeInfo) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*NodeInfo) ProtoMessage() {}

func (x *NodeInfo) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[1]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use NodeInfo.ProtoReflect.Descriptor instead.
func (*NodeInfo) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{1}
}

func (x *NodeInfo) GetNodeId() string {
	if x != nil {
		return x.NodeId
	}
	return ""
}

func (x *NodeInfo) GetCanJoin() bool {
	if x != nil {
		return x.CanJoin
	}
	return false
}

func (x *NodeInfo) GetOnlinePlayers() []string {
	if x != nil {
		return x.OnlinePlayers
	}
	return nil
}

func (x *NodeInfo) GetMaxOnlinePlayers() int32 {
	if x != nil {
		return x.MaxOnlinePlayers
	}
	return 0
}

func (x *NodeInfo) GetPerformanceInfo() *NodePerformanceInfo {
	if x != nil {
		return x.PerformanceInfo
	}
	return nil
}

type LoginRequest struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	NodeId string    `protobuf:"bytes,1,opt,name=node_id,json=nodeId,proto3" json:"node_id,omitempty"`
	Type   string    `protobuf:"bytes,2,opt,name=type,proto3" json:"type,omitempty"`
	Info   *NodeInfo `protobuf:"bytes,3,opt,name=info,proto3" json:"info,omitempty"`
}

func (x *LoginRequest) Reset() {
	*x = LoginRequest{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[2]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *LoginRequest) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*LoginRequest) ProtoMessage() {}

func (x *LoginRequest) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[2]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use LoginRequest.ProtoReflect.Descriptor instead.
func (*LoginRequest) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{2}
}

func (x *LoginRequest) GetNodeId() string {
	if x != nil {
		return x.NodeId
	}
	return ""
}

func (x *LoginRequest) GetType() string {
	if x != nil {
		return x.Type
	}
	return ""
}

func (x *LoginRequest) GetInfo() *NodeInfo {
	if x != nil {
		return x.Info
	}
	return nil
}

type LoginResponse struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	Status  LoginStatusCode `protobuf:"varint,1,opt,name=status,proto3,enum=LoginStatusCode" json:"status,omitempty"`
	Message *string         `protobuf:"bytes,2,opt,name=message,proto3,oneof" json:"message,omitempty"`
}

func (x *LoginResponse) Reset() {
	*x = LoginResponse{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[3]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *LoginResponse) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*LoginResponse) ProtoMessage() {}

func (x *LoginResponse) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[3]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use LoginResponse.ProtoReflect.Descriptor instead.
func (*LoginResponse) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{3}
}

func (x *LoginResponse) GetStatus() LoginStatusCode {
	if x != nil {
		return x.Status
	}
	return LoginStatusCode_SUCCESS
}

func (x *LoginResponse) GetMessage() string {
	if x != nil && x.Message != nil {
		return *x.Message
	}
	return ""
}

type QuitRequest struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	NodeId string `protobuf:"bytes,1,opt,name=node_id,json=nodeId,proto3" json:"node_id,omitempty"`
}

func (x *QuitRequest) Reset() {
	*x = QuitRequest{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[4]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *QuitRequest) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*QuitRequest) ProtoMessage() {}

func (x *QuitRequest) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[4]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use QuitRequest.ProtoReflect.Descriptor instead.
func (*QuitRequest) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{4}
}

func (x *QuitRequest) GetNodeId() string {
	if x != nil {
		return x.NodeId
	}
	return ""
}

type PerformanceInfoResponse struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	Info map[string]*NodePerformanceInfo `protobuf:"bytes,1,rep,name=info,proto3" json:"info,omitempty" protobuf_key:"bytes,1,opt,name=key,proto3" protobuf_val:"bytes,2,opt,name=value,proto3"`
}

func (x *PerformanceInfoResponse) Reset() {
	*x = PerformanceInfoResponse{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[5]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *PerformanceInfoResponse) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*PerformanceInfoResponse) ProtoMessage() {}

func (x *PerformanceInfoResponse) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[5]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use PerformanceInfoResponse.ProtoReflect.Descriptor instead.
func (*PerformanceInfoResponse) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{5}
}

func (x *PerformanceInfoResponse) GetInfo() map[string]*NodePerformanceInfo {
	if x != nil {
		return x.Info
	}
	return nil
}

type BroadcastMessage struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	NodeId string `protobuf:"bytes,1,opt,name=node_id,json=nodeId,proto3" json:"node_id,omitempty"`
	Topic  string `protobuf:"bytes,2,opt,name=topic,proto3" json:"topic,omitempty"`
	Data   string `protobuf:"bytes,3,opt,name=data,proto3" json:"data,omitempty"`
}

func (x *BroadcastMessage) Reset() {
	*x = BroadcastMessage{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[6]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *BroadcastMessage) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*BroadcastMessage) ProtoMessage() {}

func (x *BroadcastMessage) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[6]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use BroadcastMessage.ProtoReflect.Descriptor instead.
func (*BroadcastMessage) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{6}
}

func (x *BroadcastMessage) GetNodeId() string {
	if x != nil {
		return x.NodeId
	}
	return ""
}

func (x *BroadcastMessage) GetTopic() string {
	if x != nil {
		return x.Topic
	}
	return ""
}

func (x *BroadcastMessage) GetData() string {
	if x != nil {
		return x.Data
	}
	return ""
}

type HeartbeatResponse struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	Msg []*BroadcastMessage `protobuf:"bytes,1,rep,name=msg,proto3" json:"msg,omitempty"`
}

func (x *HeartbeatResponse) Reset() {
	*x = HeartbeatResponse{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[7]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *HeartbeatResponse) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*HeartbeatResponse) ProtoMessage() {}

func (x *HeartbeatResponse) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[7]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use HeartbeatResponse.ProtoReflect.Descriptor instead.
func (*HeartbeatResponse) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{7}
}

func (x *HeartbeatResponse) GetMsg() []*BroadcastMessage {
	if x != nil {
		return x.Msg
	}
	return nil
}

type SelectServerRequest struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	NodeId       string `protobuf:"bytes,1,opt,name=node_id,json=nodeId,proto3" json:"node_id,omitempty"`
	RequestedYpe string `protobuf:"bytes,2,opt,name=requested_ype,json=requestedYpe,proto3" json:"requested_ype,omitempty"`
}

func (x *SelectServerRequest) Reset() {
	*x = SelectServerRequest{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[8]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *SelectServerRequest) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*SelectServerRequest) ProtoMessage() {}

func (x *SelectServerRequest) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[8]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use SelectServerRequest.ProtoReflect.Descriptor instead.
func (*SelectServerRequest) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{8}
}

func (x *SelectServerRequest) GetNodeId() string {
	if x != nil {
		return x.NodeId
	}
	return ""
}

func (x *SelectServerRequest) GetRequestedYpe() string {
	if x != nil {
		return x.RequestedYpe
	}
	return ""
}

type SelectServerResponse struct {
	state         protoimpl.MessageState
	sizeCache     protoimpl.SizeCache
	unknownFields protoimpl.UnknownFields

	TargetNodeId *string `protobuf:"bytes,1,opt,name=target_node_id,json=targetNodeId,proto3,oneof" json:"target_node_id,omitempty"`
}

func (x *SelectServerResponse) Reset() {
	*x = SelectServerResponse{}
	if protoimpl.UnsafeEnabled {
		mi := &file_proto_define_proto_msgTypes[9]
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		ms.StoreMessageInfo(mi)
	}
}

func (x *SelectServerResponse) String() string {
	return protoimpl.X.MessageStringOf(x)
}

func (*SelectServerResponse) ProtoMessage() {}

func (x *SelectServerResponse) ProtoReflect() protoreflect.Message {
	mi := &file_proto_define_proto_msgTypes[9]
	if protoimpl.UnsafeEnabled && x != nil {
		ms := protoimpl.X.MessageStateOf(protoimpl.Pointer(x))
		if ms.LoadMessageInfo() == nil {
			ms.StoreMessageInfo(mi)
		}
		return ms
	}
	return mi.MessageOf(x)
}

// Deprecated: Use SelectServerResponse.ProtoReflect.Descriptor instead.
func (*SelectServerResponse) Descriptor() ([]byte, []int) {
	return file_proto_define_proto_rawDescGZIP(), []int{9}
}

func (x *SelectServerResponse) GetTargetNodeId() string {
	if x != nil && x.TargetNodeId != nil {
		return *x.TargetNodeId
	}
	return ""
}

var File_proto_define_proto protoreflect.FileDescriptor

var file_proto_define_proto_rawDesc = []byte{
	0x0a, 0x12, 0x70, 0x72, 0x6f, 0x74, 0x6f, 0x2f, 0x64, 0x65, 0x66, 0x69, 0x6e, 0x65, 0x2e, 0x70,
	0x72, 0x6f, 0x74, 0x6f, 0x22, 0x54, 0x0a, 0x13, 0x4e, 0x6f, 0x64, 0x65, 0x50, 0x65, 0x72, 0x66,
	0x6f, 0x72, 0x6d, 0x61, 0x6e, 0x63, 0x65, 0x49, 0x6e, 0x66, 0x6f, 0x12, 0x10, 0x0a, 0x03, 0x74,
	0x70, 0x73, 0x18, 0x01, 0x20, 0x01, 0x28, 0x05, 0x52, 0x03, 0x74, 0x70, 0x73, 0x12, 0x1f, 0x0a,
	0x0b, 0x61, 0x76, 0x65, 0x72, 0x61, 0x67, 0x65, 0x5f, 0x74, 0x70, 0x73, 0x18, 0x02, 0x20, 0x01,
	0x28, 0x02, 0x52, 0x0a, 0x61, 0x76, 0x65, 0x72, 0x61, 0x67, 0x65, 0x54, 0x70, 0x73, 0x4a, 0x04,
	0x08, 0x03, 0x10, 0x04, 0x4a, 0x04, 0x08, 0x06, 0x10, 0x07, 0x22, 0xd3, 0x01, 0x0a, 0x08, 0x4e,
	0x6f, 0x64, 0x65, 0x49, 0x6e, 0x66, 0x6f, 0x12, 0x17, 0x0a, 0x07, 0x6e, 0x6f, 0x64, 0x65, 0x5f,
	0x69, 0x64, 0x18, 0x01, 0x20, 0x01, 0x28, 0x09, 0x52, 0x06, 0x6e, 0x6f, 0x64, 0x65, 0x49, 0x64,
	0x12, 0x18, 0x0a, 0x07, 0x63, 0x61, 0x6e, 0x4a, 0x6f, 0x69, 0x6e, 0x18, 0x02, 0x20, 0x01, 0x28,
	0x08, 0x52, 0x07, 0x63, 0x61, 0x6e, 0x4a, 0x6f, 0x69, 0x6e, 0x12, 0x25, 0x0a, 0x0e, 0x6f, 0x6e,
	0x6c, 0x69, 0x6e, 0x65, 0x5f, 0x70, 0x6c, 0x61, 0x79, 0x65, 0x72, 0x73, 0x18, 0x03, 0x20, 0x03,
	0x28, 0x09, 0x52, 0x0d, 0x6f, 0x6e, 0x6c, 0x69, 0x6e, 0x65, 0x50, 0x6c, 0x61, 0x79, 0x65, 0x72,
	0x73, 0x12, 0x2c, 0x0a, 0x12, 0x6d, 0x61, 0x78, 0x5f, 0x6f, 0x6e, 0x6c, 0x69, 0x6e, 0x65, 0x5f,
	0x70, 0x6c, 0x61, 0x79, 0x65, 0x72, 0x73, 0x18, 0x04, 0x20, 0x01, 0x28, 0x05, 0x52, 0x10, 0x6d,
	0x61, 0x78, 0x4f, 0x6e, 0x6c, 0x69, 0x6e, 0x65, 0x50, 0x6c, 0x61, 0x79, 0x65, 0x72, 0x73, 0x12,
	0x3f, 0x0a, 0x10, 0x70, 0x65, 0x72, 0x66, 0x6f, 0x72, 0x6d, 0x61, 0x6e, 0x63, 0x65, 0x5f, 0x69,
	0x6e, 0x66, 0x6f, 0x18, 0x05, 0x20, 0x01, 0x28, 0x0b, 0x32, 0x14, 0x2e, 0x4e, 0x6f, 0x64, 0x65,
	0x50, 0x65, 0x72, 0x66, 0x6f, 0x72, 0x6d, 0x61, 0x6e, 0x63, 0x65, 0x49, 0x6e, 0x66, 0x6f, 0x52,
	0x0f, 0x70, 0x65, 0x72, 0x66, 0x6f, 0x72, 0x6d, 0x61, 0x6e, 0x63, 0x65, 0x49, 0x6e, 0x66, 0x6f,
	0x22, 0x5a, 0x0a, 0x0c, 0x4c, 0x6f, 0x67, 0x69, 0x6e, 0x52, 0x65, 0x71, 0x75, 0x65, 0x73, 0x74,
	0x12, 0x17, 0x0a, 0x07, 0x6e, 0x6f, 0x64, 0x65, 0x5f, 0x69, 0x64, 0x18, 0x01, 0x20, 0x01, 0x28,
	0x09, 0x52, 0x06, 0x6e, 0x6f, 0x64, 0x65, 0x49, 0x64, 0x12, 0x12, 0x0a, 0x04, 0x74, 0x79, 0x70,
	0x65, 0x18, 0x02, 0x20, 0x01, 0x28, 0x09, 0x52, 0x04, 0x74, 0x79, 0x70, 0x65, 0x12, 0x1d, 0x0a,
	0x04, 0x69, 0x6e, 0x66, 0x6f, 0x18, 0x03, 0x20, 0x01, 0x28, 0x0b, 0x32, 0x09, 0x2e, 0x4e, 0x6f,
	0x64, 0x65, 0x49, 0x6e, 0x66, 0x6f, 0x52, 0x04, 0x69, 0x6e, 0x66, 0x6f, 0x22, 0x64, 0x0a, 0x0d,
	0x4c, 0x6f, 0x67, 0x69, 0x6e, 0x52, 0x65, 0x73, 0x70, 0x6f, 0x6e, 0x73, 0x65, 0x12, 0x28, 0x0a,
	0x06, 0x73, 0x74, 0x61, 0x74, 0x75, 0x73, 0x18, 0x01, 0x20, 0x01, 0x28, 0x0e, 0x32, 0x10, 0x2e,
	0x4c, 0x6f, 0x67, 0x69, 0x6e, 0x53, 0x74, 0x61, 0x74, 0x75, 0x73, 0x43, 0x6f, 0x64, 0x65, 0x52,
	0x06, 0x73, 0x74, 0x61, 0x74, 0x75, 0x73, 0x12, 0x1d, 0x0a, 0x07, 0x6d, 0x65, 0x73, 0x73, 0x61,
	0x67, 0x65, 0x18, 0x02, 0x20, 0x01, 0x28, 0x09, 0x48, 0x00, 0x52, 0x07, 0x6d, 0x65, 0x73, 0x73,
	0x61, 0x67, 0x65, 0x88, 0x01, 0x01, 0x42, 0x0a, 0x0a, 0x08, 0x5f, 0x6d, 0x65, 0x73, 0x73, 0x61,
	0x67, 0x65, 0x22, 0x26, 0x0a, 0x0b, 0x51, 0x75, 0x69, 0x74, 0x52, 0x65, 0x71, 0x75, 0x65, 0x73,
	0x74, 0x12, 0x17, 0x0a, 0x07, 0x6e, 0x6f, 0x64, 0x65, 0x5f, 0x69, 0x64, 0x18, 0x01, 0x20, 0x01,
	0x28, 0x09, 0x52, 0x06, 0x6e, 0x6f, 0x64, 0x65, 0x49, 0x64, 0x22, 0xa0, 0x01, 0x0a, 0x17, 0x50,
	0x65, 0x72, 0x66, 0x6f, 0x72, 0x6d, 0x61, 0x6e, 0x63, 0x65, 0x49, 0x6e, 0x66, 0x6f, 0x52, 0x65,
	0x73, 0x70, 0x6f, 0x6e, 0x73, 0x65, 0x12, 0x36, 0x0a, 0x04, 0x69, 0x6e, 0x66, 0x6f, 0x18, 0x01,
	0x20, 0x03, 0x28, 0x0b, 0x32, 0x22, 0x2e, 0x50, 0x65, 0x72, 0x66, 0x6f, 0x72, 0x6d, 0x61, 0x6e,
	0x63, 0x65, 0x49, 0x6e, 0x66, 0x6f, 0x52, 0x65, 0x73, 0x70, 0x6f, 0x6e, 0x73, 0x65, 0x2e, 0x49,
	0x6e, 0x66, 0x6f, 0x45, 0x6e, 0x74, 0x72, 0x79, 0x52, 0x04, 0x69, 0x6e, 0x66, 0x6f, 0x1a, 0x4d,
	0x0a, 0x09, 0x49, 0x6e, 0x66, 0x6f, 0x45, 0x6e, 0x74, 0x72, 0x79, 0x12, 0x10, 0x0a, 0x03, 0x6b,
	0x65, 0x79, 0x18, 0x01, 0x20, 0x01, 0x28, 0x09, 0x52, 0x03, 0x6b, 0x65, 0x79, 0x12, 0x2a, 0x0a,
	0x05, 0x76, 0x61, 0x6c, 0x75, 0x65, 0x18, 0x02, 0x20, 0x01, 0x28, 0x0b, 0x32, 0x14, 0x2e, 0x4e,
	0x6f, 0x64, 0x65, 0x50, 0x65, 0x72, 0x66, 0x6f, 0x72, 0x6d, 0x61, 0x6e, 0x63, 0x65, 0x49, 0x6e,
	0x66, 0x6f, 0x52, 0x05, 0x76, 0x61, 0x6c, 0x75, 0x65, 0x3a, 0x02, 0x38, 0x01, 0x22, 0x55, 0x0a,
	0x10, 0x42, 0x72, 0x6f, 0x61, 0x64, 0x63, 0x61, 0x73, 0x74, 0x4d, 0x65, 0x73, 0x73, 0x61, 0x67,
	0x65, 0x12, 0x17, 0x0a, 0x07, 0x6e, 0x6f, 0x64, 0x65, 0x5f, 0x69, 0x64, 0x18, 0x01, 0x20, 0x01,
	0x28, 0x09, 0x52, 0x06, 0x6e, 0x6f, 0x64, 0x65, 0x49, 0x64, 0x12, 0x14, 0x0a, 0x05, 0x74, 0x6f,
	0x70, 0x69, 0x63, 0x18, 0x02, 0x20, 0x01, 0x28, 0x09, 0x52, 0x05, 0x74, 0x6f, 0x70, 0x69, 0x63,
	0x12, 0x12, 0x0a, 0x04, 0x64, 0x61, 0x74, 0x61, 0x18, 0x03, 0x20, 0x01, 0x28, 0x09, 0x52, 0x04,
	0x64, 0x61, 0x74, 0x61, 0x22, 0x38, 0x0a, 0x11, 0x48, 0x65, 0x61, 0x72, 0x74, 0x62, 0x65, 0x61,
	0x74, 0x52, 0x65, 0x73, 0x70, 0x6f, 0x6e, 0x73, 0x65, 0x12, 0x23, 0x0a, 0x03, 0x6d, 0x73, 0x67,
	0x18, 0x01, 0x20, 0x03, 0x28, 0x0b, 0x32, 0x11, 0x2e, 0x42, 0x72, 0x6f, 0x61, 0x64, 0x63, 0x61,
	0x73, 0x74, 0x4d, 0x65, 0x73, 0x73, 0x61, 0x67, 0x65, 0x52, 0x03, 0x6d, 0x73, 0x67, 0x22, 0x53,
	0x0a, 0x13, 0x53, 0x65, 0x6c, 0x65, 0x63, 0x74, 0x53, 0x65, 0x72, 0x76, 0x65, 0x72, 0x52, 0x65,
	0x71, 0x75, 0x65, 0x73, 0x74, 0x12, 0x17, 0x0a, 0x07, 0x6e, 0x6f, 0x64, 0x65, 0x5f, 0x69, 0x64,
	0x18, 0x01, 0x20, 0x01, 0x28, 0x09, 0x52, 0x06, 0x6e, 0x6f, 0x64, 0x65, 0x49, 0x64, 0x12, 0x23,
	0x0a, 0x0d, 0x72, 0x65, 0x71, 0x75, 0x65, 0x73, 0x74, 0x65, 0x64, 0x5f, 0x79, 0x70, 0x65, 0x18,
	0x02, 0x20, 0x01, 0x28, 0x09, 0x52, 0x0c, 0x72, 0x65, 0x71, 0x75, 0x65, 0x73, 0x74, 0x65, 0x64,
	0x59, 0x70, 0x65, 0x22, 0x54, 0x0a, 0x14, 0x53, 0x65, 0x6c, 0x65, 0x63, 0x74, 0x53, 0x65, 0x72,
	0x76, 0x65, 0x72, 0x52, 0x65, 0x73, 0x70, 0x6f, 0x6e, 0x73, 0x65, 0x12, 0x29, 0x0a, 0x0e, 0x74,
	0x61, 0x72, 0x67, 0x65, 0x74, 0x5f, 0x6e, 0x6f, 0x64, 0x65, 0x5f, 0x69, 0x64, 0x18, 0x01, 0x20,
	0x01, 0x28, 0x09, 0x48, 0x00, 0x52, 0x0c, 0x74, 0x61, 0x72, 0x67, 0x65, 0x74, 0x4e, 0x6f, 0x64,
	0x65, 0x49, 0x64, 0x88, 0x01, 0x01, 0x42, 0x11, 0x0a, 0x0f, 0x5f, 0x74, 0x61, 0x72, 0x67, 0x65,
	0x74, 0x5f, 0x6e, 0x6f, 0x64, 0x65, 0x5f, 0x69, 0x64, 0x2a, 0x2a, 0x0a, 0x0f, 0x4c, 0x6f, 0x67,
	0x69, 0x6e, 0x53, 0x74, 0x61, 0x74, 0x75, 0x73, 0x43, 0x6f, 0x64, 0x65, 0x12, 0x0b, 0x0a, 0x07,
	0x53, 0x55, 0x43, 0x43, 0x45, 0x53, 0x53, 0x10, 0x00, 0x12, 0x0a, 0x0a, 0x06, 0x46, 0x41, 0x49,
	0x4c, 0x45, 0x44, 0x10, 0x01, 0x42, 0x1b, 0x5a, 0x06, 0x70, 0x72, 0x6f, 0x74, 0x6f, 0x2f, 0xca,
	0x02, 0x10, 0x70, 0x72, 0x6f, 0x6b, 0x69, 0x74, 0x73, 0x5c, 0x70, 0x72, 0x6f, 0x74, 0x6f, 0x63,
	0x6f, 0x6c, 0x62, 0x06, 0x70, 0x72, 0x6f, 0x74, 0x6f, 0x33,
}

var (
	file_proto_define_proto_rawDescOnce sync.Once
	file_proto_define_proto_rawDescData = file_proto_define_proto_rawDesc
)

func file_proto_define_proto_rawDescGZIP() []byte {
	file_proto_define_proto_rawDescOnce.Do(func() {
		file_proto_define_proto_rawDescData = protoimpl.X.CompressGZIP(file_proto_define_proto_rawDescData)
	})
	return file_proto_define_proto_rawDescData
}

var file_proto_define_proto_enumTypes = make([]protoimpl.EnumInfo, 1)
var file_proto_define_proto_msgTypes = make([]protoimpl.MessageInfo, 11)
var file_proto_define_proto_goTypes = []interface{}{
	(LoginStatusCode)(0),            // 0: LoginStatusCode
	(*NodePerformanceInfo)(nil),     // 1: NodePerformanceInfo
	(*NodeInfo)(nil),                // 2: NodeInfo
	(*LoginRequest)(nil),            // 3: LoginRequest
	(*LoginResponse)(nil),           // 4: LoginResponse
	(*QuitRequest)(nil),             // 5: QuitRequest
	(*PerformanceInfoResponse)(nil), // 6: PerformanceInfoResponse
	(*BroadcastMessage)(nil),        // 7: BroadcastMessage
	(*HeartbeatResponse)(nil),       // 8: HeartbeatResponse
	(*SelectServerRequest)(nil),     // 9: SelectServerRequest
	(*SelectServerResponse)(nil),    // 10: SelectServerResponse
	nil,                             // 11: PerformanceInfoResponse.InfoEntry
}
var file_proto_define_proto_depIdxs = []int32{
	1,  // 0: NodeInfo.performance_info:type_name -> NodePerformanceInfo
	2,  // 1: LoginRequest.info:type_name -> NodeInfo
	0,  // 2: LoginResponse.status:type_name -> LoginStatusCode
	11, // 3: PerformanceInfoResponse.info:type_name -> PerformanceInfoResponse.InfoEntry
	7,  // 4: HeartbeatResponse.msg:type_name -> BroadcastMessage
	1,  // 5: PerformanceInfoResponse.InfoEntry.value:type_name -> NodePerformanceInfo
	6,  // [6:6] is the sub-list for method output_type
	6,  // [6:6] is the sub-list for method input_type
	6,  // [6:6] is the sub-list for extension type_name
	6,  // [6:6] is the sub-list for extension extendee
	0,  // [0:6] is the sub-list for field type_name
}

func init() { file_proto_define_proto_init() }
func file_proto_define_proto_init() {
	if File_proto_define_proto != nil {
		return
	}
	if !protoimpl.UnsafeEnabled {
		file_proto_define_proto_msgTypes[0].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*NodePerformanceInfo); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
		file_proto_define_proto_msgTypes[1].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*NodeInfo); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
		file_proto_define_proto_msgTypes[2].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*LoginRequest); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
		file_proto_define_proto_msgTypes[3].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*LoginResponse); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
		file_proto_define_proto_msgTypes[4].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*QuitRequest); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
		file_proto_define_proto_msgTypes[5].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*PerformanceInfoResponse); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
		file_proto_define_proto_msgTypes[6].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*BroadcastMessage); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
		file_proto_define_proto_msgTypes[7].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*HeartbeatResponse); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
		file_proto_define_proto_msgTypes[8].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*SelectServerRequest); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
		file_proto_define_proto_msgTypes[9].Exporter = func(v interface{}, i int) interface{} {
			switch v := v.(*SelectServerResponse); i {
			case 0:
				return &v.state
			case 1:
				return &v.sizeCache
			case 2:
				return &v.unknownFields
			default:
				return nil
			}
		}
	}
	file_proto_define_proto_msgTypes[3].OneofWrappers = []interface{}{}
	file_proto_define_proto_msgTypes[9].OneofWrappers = []interface{}{}
	type x struct{}
	out := protoimpl.TypeBuilder{
		File: protoimpl.DescBuilder{
			GoPackagePath: reflect.TypeOf(x{}).PkgPath(),
			RawDescriptor: file_proto_define_proto_rawDesc,
			NumEnums:      1,
			NumMessages:   11,
			NumExtensions: 0,
			NumServices:   0,
		},
		GoTypes:           file_proto_define_proto_goTypes,
		DependencyIndexes: file_proto_define_proto_depIdxs,
		EnumInfos:         file_proto_define_proto_enumTypes,
		MessageInfos:      file_proto_define_proto_msgTypes,
	}.Build()
	File_proto_define_proto = out.File
	file_proto_define_proto_rawDesc = nil
	file_proto_define_proto_goTypes = nil
	file_proto_define_proto_depIdxs = nil
}