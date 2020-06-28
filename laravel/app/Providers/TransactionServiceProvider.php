<?php

namespace Framework\Providers;

use Framework\Libraries\Uuid;

class TransactionServiceProvider {
    protected $transactionId;

    public function __construct() {
        //
    }

    /**
     * Generate transaction id
     *
     * @return string
     */
    public function generate() {
        return $this->transactionId = strval(Uuid::generate(4));
    }

    /**
     * Get transaction id
     *
     * @return string
     */
    public function get() {
        return $this->transactionId;
    }

    /**
     * Set transaction id
     *
     * @return void
     */
    public function set($transactionId) {
        $this->transactionId = $transactionId;
    }
}
