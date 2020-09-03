<?php

namespace App\Http\Livewire;

use App\Utilities\Arr;
use App\Utilities\Flash;
use App\Utilities\Str;

/**
 * Add alert message tooling to a livewire component.
 */
trait DisplaysAlerts
{
    /**
     * @var array
     */
    public $messages = [];

    /**
     * Add a message.
     *
     * @param string|array $message
     * @param string $type
     * @return void
     */
    public function alert($message, $type = 'info')
    {
        $id = Str::random(20);

        if (is_array($message) && Arr::has($message, 'text')) {
            $this->messages[$id] = [
                'id' => $id,
                'text' => Arr::get($message, 'text'),
                'type' => Arr::get($message, 'type', 'info'),
                'url' => Arr::get($message, 'url'),
                'link' => Arr::get($message, 'link'),
            ];
        }

        if (is_string($message)) {
            $this->messages[$id] = [
                'id' => $id,
                'text' => $message,
                'type' => $type,
            ];
        }
    }

    /**
     * Remove a single message.
     *
     * @param string $identifier
     * @return void
     */
    public function removeAlert($identifier)
    {
        unset($this->messages[$identifier]);
    }

    /**
     * Remove all messages.
     *
     * @return void
     */
    public function clearAlerts()
    {
        $this->messages = [];
    }

    /**
     * Add a flash message to the current session.
     *
     * @param  string|null $message
     * @param  string      $level
     * @return void
     */
    public function flash($text = null, $type = 'info')
    {
        Flash::message($text, $type);
    }
}
