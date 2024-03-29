<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/define.proto

namespace prokits\protocol;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>LoginResponse</code>
 */
class LoginResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.LoginStatusCode status = 1;</code>
     */
    protected $status = 0;
    /**
     * Generated from protobuf field <code>optional string message = 2;</code>
     */
    protected $message = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $status
     *     @type string $message
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Define::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.LoginStatusCode status = 1;</code>
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Generated from protobuf field <code>.LoginStatusCode status = 1;</code>
     * @param int $var
     * @return $this
     */
    public function setStatus($var)
    {
        GPBUtil::checkEnum($var, \prokits\protocol\LoginStatusCode::class);
        $this->status = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional string message = 2;</code>
     * @return string
     */
    public function getMessage()
    {
        return isset($this->message) ? $this->message : '';
    }

    public function hasMessage()
    {
        return isset($this->message);
    }

    public function clearMessage()
    {
        unset($this->message);
    }

    /**
     * Generated from protobuf field <code>optional string message = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setMessage($var)
    {
        GPBUtil::checkString($var, True);
        $this->message = $var;

        return $this;
    }

}

