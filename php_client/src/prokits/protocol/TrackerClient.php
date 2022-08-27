<?php
// GENERATED CODE -- DO NOT EDIT!

namespace prokits\protocol;

/**
 */
class TrackerClient extends \Grpc\BaseStub {

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
        return $this->_simpleRequest('/Tracker/Login',
        $argument,
        ['\prokits\protocol\LoginResponse', 'decode'],
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
        return $this->_simpleRequest('/Tracker/Heartbeat',
        $argument,
        ['\prokits\protocol\HeartbeatResponse', 'decode'],
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
        return $this->_simpleRequest('/Tracker/GetAllPerformanceInfo',
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
        return $this->_simpleRequest('/Tracker/Broadcast',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \prokits\protocol\SelectServerRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Select(\prokits\protocol\SelectServerRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Tracker/Select',
        $argument,
        ['\prokits\protocol\SelectServerResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \prokits\protocol\QuitRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Quit(\prokits\protocol\QuitRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/Tracker/Quit',
        $argument,
        ['\Google\Protobuf\GPBEmpty', 'decode'],
        $metadata, $options);
    }

}
