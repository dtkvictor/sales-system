<?php

namespace App\Helpers;

class NumberUtils 
{
    /**
     * Abbreviates a number to the corresponding unit of measurement.
     * @param int|float $number
     * @return string
     * @exemple 1000 => 1K
     *          1000000 => 1M
     *          1000000000 => 1B
    */

    public static function abbreviateNumber(int|float $number): string
    {
        if($number >= 1000000000000) return round($number / 1000000000000, 1)."T";
        else if($number >= 1000000000) return round($number / 1000000000, 1)."B";
        else if($number >= 1000000) return round($number / 1000000, 1)."M";
        else if($number >= 1000) return round($number / 1000, 1)."K";
        return $number;
    }
} 