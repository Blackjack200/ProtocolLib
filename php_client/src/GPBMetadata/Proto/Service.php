<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/service.proto

namespace GPBMetadata\Proto;

class Service
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Proto\Define::initOnce();
        \GPBMetadata\Google\Protobuf\GPBEmpty::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
proto/service.protogoogle/protobuf/empty.proto2�
Server&
Login
GetAllPerformanceInfo.google.protobuf.Empty.PerformanceInfoResponse6
	Broadcast.BroadcastMessage.google.protobuf.Empty*
	Heartbeat	.NodeInfo.HeartbeatResponseBZproto/�prokits\\protocolbproto3'
        , true);

        static::$is_initialized = true;
    }
}
