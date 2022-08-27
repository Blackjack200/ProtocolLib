<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/define.proto

namespace prokits\protocol;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>NodePerformanceInfo</code>
 */
class NodePerformanceInfo extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>int32 tps = 1;</code>
     */
    protected $tps = 0;
    /**
     * Generated from protobuf field <code>float average_tps = 2;</code>
     */
    protected $average_tps = 0.0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $tps
     *     @type float $average_tps
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Define::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>int32 tps = 1;</code>
     * @return int
     */
    public function getTps()
    {
        return $this->tps;
    }

    /**
     * Generated from protobuf field <code>int32 tps = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setTps($var)
    {
        GPBUtil::checkInt32($var);
        $this->tps = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>float average_tps = 2;</code>
     * @return float
     */
    public function getAverageTps()
    {
        return $this->average_tps;
    }

    /**
     * Generated from protobuf field <code>float average_tps = 2;</code>
     * @param float $var
     * @return $this
     */
    public function setAverageTps($var)
    {
        GPBUtil::checkFloat($var);
        $this->average_tps = $var;

        return $this;
    }

}

