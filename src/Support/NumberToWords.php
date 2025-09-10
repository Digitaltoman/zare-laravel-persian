<?php

namespace Zare\LaravelPersian\Support;

use Kavenegar\PersianTools\Number;

class NumberToWords
{
    public static function convert($number)
    {
        return Number::toWords($number);
    }
}
