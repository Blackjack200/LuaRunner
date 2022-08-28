<?php
// GENERATED CODE -- DO NOT EDIT!

namespace blackjack200\lua;

/**
 */
class EvaluatorClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \blackjack200\lua\EvaluateRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function Eval(\blackjack200\lua\EvaluateRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/lua.Evaluator/Eval',
        $argument,
        ['\blackjack200\lua\EvaluateResponse', 'decode'],
        $metadata, $options);
    }

}
