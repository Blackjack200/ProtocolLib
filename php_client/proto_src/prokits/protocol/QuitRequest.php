<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/define.proto

namespace prokits\protocol;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>QuitRequest</code>
 */
class QuitRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string node_id = 1;</code>
     */
    protected $node_id = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $node_id
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

}

