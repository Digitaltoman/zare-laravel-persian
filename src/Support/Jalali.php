<?php

namespace Zare\LaravelPersian\Support;

use Morilog\Jalali\Jalalian;

class Jalali
{
    public static function toJalali($date)
    {
        return Jalalian::fromDateTime($date)->format('Y/m/d');
    }

    public static function toGregorian($date)
    {
        return Jalalian::fromFormat('Y/m/d', $date)->toCarbon();
    }
}
