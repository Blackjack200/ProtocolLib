<?php
// GENERATED CODE -- DO NOT EDIT!

namespace prokits\protocol;

/**
 */
class ServerClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \prokits\protocol\LoginRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Login(\prokits\protocol\LoginRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ProtocolLib.Server/Login',
        $argument,
        ['\prokits\protocol\LoginResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Google\Protobuf\GPBEmpty $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function GetAllPerformanceInfo(\Google\Protobuf\GPBEmpty $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ProtocolLib.Server/GetAllPerformanceInfo',
        $argument,
        ['\prokits\protocol\PerformanceInfoResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \prokits\protocol\BroadcastMessage $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Broadcast(\prokits\protocol\BroadcastMessage $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ProtocolLib.Server/Broadcast',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \prokits\protocol\NodeInfo $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Heartbeat(\prokits\protocol\NodeInfo $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/ProtocolLib.Server/Heartbeat',
        $argument,
        ['\prokits\protocol\HeartbeatResponse', 'decode'],
        $metadata, $options);
    }

}
