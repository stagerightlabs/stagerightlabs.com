<?php

namespace App\Utilities;

use Illuminate\Support\Arr as IlluminateArr;

class Arr extends IlluminateArr
{
    /**
     * Determine if an associative array is missing expected keys.
     * Returns an array of the missing keys.
     *
     * @param array $array
     * @param array|string $keys
     * @return array
     */
    public static function disclose($array, $keys)
    {
        if (is_string($keys)) {
            $keys = [$keys];
        }

        $missing = [];

        foreach ($keys as $expected) {
            if (!array_key_exists($expected, $array)) {
                array_push($missing, $expected);
            }
        }

        return $missing;
    }
}
