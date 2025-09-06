<?php

declare(strict_types=1);

namespace Blog\Support;

final class Arr
{
    /**
     * Retrieve a string from an array.
     *
     * @param mixed $target
     * @param string|int|null $key
     * @param string|null $default
     * @return string|null
     */
    public static function string($target, $key, ?string $default = null): ?string
    {
        $value = data_get($target, $key, $default);

        return $value ? strval($value) : null;
    }

    /**
     * Retrieve an integer from an array.
     *
     * @param mixed $target
     * @param string|int|null $key
     * @param int|null $default
     * @return int|null
     */
    public static function integer($target, $key, ?int $default = null): ?int
    {
        $value = data_get($target, $key, $default);

        return $value ? intval($value) : null;
    }

    /**
     * Retrieve an array from an array.
     *
     * @param mixed $target
     * @param string|int|null $key
     * @param array<mixed>|null $default
     * @return array<mixed>|null
     */
    public static function array($target, $key, ?array $default = null): ?array
    {
        $value = data_get($target, $key, $default);

        return $value ? (array)$value : null;
    }
}
