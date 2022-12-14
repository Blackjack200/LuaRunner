<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/service.proto

namespace blackjack200\lua;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>lua.EvaluateRequest</code>
 */
class EvaluateRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string code = 1;</code>
     */
    protected $code = '';
    /**
     * Generated from protobuf field <code>map<string, string> variables = 2;</code>
     */
    private $variables;
    /**
     * Generated from protobuf field <code>map<string, string> functions = 3;</code>
     */
    private $functions;
    /**
     * Generated from protobuf field <code>string hostname = 4;</code>
     */
    protected $hostname = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $code
     *     @type array|\Google\Protobuf\Internal\MapField $variables
     *     @type array|\Google\Protobuf\Internal\MapField $functions
     *     @type string $hostname
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Proto\Service::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string code = 1;</code>
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Generated from protobuf field <code>string code = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setCode($var)
    {
        GPBUtil::checkString($var, True);
        $this->code = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>map<string, string> variables = 2;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Generated from protobuf field <code>map<string, string> variables = 2;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setVariables($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->variables = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>map<string, string> functions = 3;</code>
     * @return \Google\Protobuf\Internal\MapField
     */
    public function getFunctions()
    {
        return $this->functions;
    }

    /**
     * Generated from protobuf field <code>map<string, string> functions = 3;</code>
     * @param array|\Google\Protobuf\Internal\MapField $var
     * @return $this
     */
    public function setFunctions($var)
    {
        $arr = GPBUtil::checkMapField($var, \Google\Protobuf\Internal\GPBType::STRING, \Google\Protobuf\Internal\GPBType::STRING);
        $this->functions = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string hostname = 4;</code>
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * Generated from protobuf field <code>string hostname = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setHostname($var)
    {
        GPBUtil::checkString($var, True);
        $this->hostname = $var;

        return $this;
    }

}

