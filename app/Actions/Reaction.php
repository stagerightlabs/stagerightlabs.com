<?php

namespace App\Actions;

/**
 * A Data Transfer Object that conveys the status of an attempted action.
 */
abstract class Reaction
{
    /**
     * An array of data we are sending back to the requesting controller.
     *
     * @var array
     */
    protected $payload;

    /**
     * A string representing a message that we might want to convey to the user.
     *
     * @var string
     */
    protected $message;

    /**
     * A boolean representing an outcome status.
     *
     * @var bool
     */
    protected $complete;

    /**
     * @param string $message
     * @param array $payload
     */
    public function __construct($message = '', array $payload = [])
    {
        $this->message = $message;
        $this->payload = $payload;
    }

    /**
     * @return mixed
     */
    public function completed()
    {
        return $this->complete == true;
    }

    /**
     * @return mixed
     */
    public function failed()
    {
        return $this->complete == false;
    }

    /**
     * @return bool
     */
    public function getCompletionStatus()
    {
        return $this->complete;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Retrieve the payload.
     *
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * "Dump" the result message to stdout.
     *
     * @return $this
     */
    public function dump()
    {
        dump($this->getMessage());

        return $this;
    }

    /**
     * Retrieve an item from the payload.
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (! array_key_exists($key, $this->payload)) {
            return;
        }

        return $this->payload[$key];
    }

    /**
     * Add an item to the payload.
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->payload[$key] = $value;
    }

    /**
     * Convert this reply into an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'message' => $this->message,
            'payload' => $this->payload,
        ];
    }
}
