<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/define.proto

namespace prokits\protocol;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>ProtocolLib.LoginRequest</code>
 */
class LoginRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string node_id = 1;</code>
     */
    protected $node_id = '';
    /**
     * Generated from protobuf field <code>string type = 2;</code>
     */
    protected $type = '';
    /**
     * Generated from protobuf field <code>.ProtocolLib.NodePerformanceInfo info = 3;</code>
     */
    protected $info = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $node_id
     *     @type string $type
     *     @type \prokits\protocol\NodePerformanceInfo $info
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Define::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string node_id = 1;</code>
     * @return string
     */
    public function getNodeId()
    {
        return $this->node_id;
    }

    /**
     * Generated from protobuf field <code>string node_id = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setNodeId($var)
    {
        GPBUtil::checkString($var, True);
        $this->node_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string type = 2;</code>
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Generated from protobuf field <code>string type = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkString($var, True);
        $this->type = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.ProtocolLib.NodePerformanceInfo info = 3;</code>
     * @return \prokits\protocol\NodePerformanceInfo|null
     */
    public function getInfo()
    {
        return $this->info;
    }

    public function hasInfo()
    {
        return isset($this->info);
    }

    public function clearInfo()
    {
        unset($this->info);
    }

    /**
     * Generated from protobuf field <code>.ProtocolLib.NodePerformanceInfo info = 3;</code>
     * @param \prokits\protocol\NodePerformanceInfo $var
     * @return $this
     */
    public function setInfo($var)
    {
        GPBUtil::checkMessage($var, \prokits\protocol\NodePerformanceInfo::class);
        $this->info = $var;

        return $this;
    }

}

