<?php

namespace App\Actions;

/**
 * A generic DTO representing a failed outcome.
 */
class Failure extends Reaction
{
    /**
     * @param string $message
     * @param array $payload
     */
    public function __construct($message = '', array $payload = [])
    {
        parent::__construct($message, $payload);

        $this->complete = false;

        if (empty($message)) {
            $message = 'error';
        }
    }
}
