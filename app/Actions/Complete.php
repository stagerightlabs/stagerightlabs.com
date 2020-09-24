<?php

namespace App\Actions;

/**
 * A generic DTO representing a successful outcome.
 */
class Complete extends Reaction
{
    /**
     * @param string $message
     * @param array $payload
     */
    public function __construct($message = '', array $payload = [])
    {
        parent::__construct($message, $payload);

        $this->complete = true;

        if (empty($message)) {
            $message = 'success';
        }
    }
}
