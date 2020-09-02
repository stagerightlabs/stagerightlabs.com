<?php

namespace App\Utilities;

class Flash
{
    /**
     * Record a flash message in the current session.
     *
     * @param string|array|null $text
     * @param string $type
     * @return void
     */
    public static function message($text = null, $type = 'info')
    {
        $id = Str::random(20);
        $message = [];

        if (is_array($text) && Arr::has($text, 'text')) {
            $message = [
                'id' => $id,
                'text' => Arr::get($text, 'text'),
                'type' => Arr::get($text, 'type', 'info'),
                'url' => Arr::get($text, 'url'),
                'link' => Arr::get($text, 'link'),
            ];
        }

        if (is_string($text)) {
            $message = [
                'id' => $id,
                'text' => $text,
                'type' => $type,
            ];
        }

        $alerts = session()->get('alerts', []);
        $alerts[$id] = $message;
        session()->flash('alerts', $alerts);
    }

    /**
     * Record a 'success' flash message to the session.
     *
     * @param string|array|null $text
     * @return void
     */
    public static function success($text = null)
    {
        self::message($text, 'success');
    }

    /**
     * Record an 'info' flash message to the session.
     *
     * @param string|array|null $text
     * @return void
     */
    public static function info($text = null)
    {
        self::message($text, 'info');
    }

    /**
     * Record a 'warning' flash message to the session.
     *
     * @param string|array|null $text
     * @return void
     */
    public static function warning($text = null)
    {
        self::message($text, 'warning');
    }

    /**
     * Record an 'error' flash message to the session.
     *
     * @param string|array|null $text
     * @return void
     */
    public static function error($text = null)
    {
        self::message($text, 'error');
    }
}
