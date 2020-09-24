<?php

namespace App\Utilities;

use Illuminate\Support\Str as IlluminateStr;

class Str extends IlluminateStr
{
    /**
     * Generate a random sequence of letters without blocked substrings.
     *
     * @param int $length
     * @return string
     */
    public static function safeRandom($length = 8)
    {
        $pool = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';

        do {
            $candidate = substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
        } while (self::containsBlockedStrings($candidate));

        return $candidate;
    }

    /**
     * Does a string contain blocked substrings?
     *
     * @param string $haystack
     * @return bool
     */
    public static function containsBlockedStrings($haystack)
    {
        $needles = [
            'ACE', 'AGE', 'AGO', 'AID', 'AIL', 'AIM', 'ALE', 'ALL', 'AMP',
            'APE', 'ARE', 'ART', 'ASH', 'ASS', 'ATE', 'BAD', 'BAG', 'BAN',
            'BRA', 'BUM', 'CON', 'COP', 'COW', 'COX', 'DAB', 'DAM', 'DIE',
            'EEL', 'FAT', 'GAY', 'GOB', 'GOD', 'GUN', 'ICK', 'ILL', 'IMP',
            'ISM', 'ITS', 'JAP', 'KEG', 'LOG', 'LOO', 'NOB', 'OAF', 'ODE',
            'ONE', 'PEE', 'PIG', 'POO', 'POT', 'PUS', 'RAW', 'RIM', 'SAD',
            'SEX', 'SIN', 'STY', 'TIC', 'TIE', 'TIP', 'TIT', 'TUG', 'TWO',
            'UGH', 'UKE', 'UMP', 'URN', 'WAD', 'WHY', 'WIZ', 'WOG', 'ZIT',
            'ZOO', 'BOOB', 'FUCK', 'SHIT', 'JAIL', 'NARC', 'FUZZ', 'PIGS',
            'TITS', 'DICK', 'MILF', 'CUNT',
        ];

        // Check the needles against the haystack
        return self::contains(strtoupper($haystack), $needles);
    }
}
