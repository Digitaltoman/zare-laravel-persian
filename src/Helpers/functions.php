<?php

use Zare\LaravelPersian\Support\Converter;
use Zare\LaravelPersian\Support\Jalali;
use Zare\LaravelPersian\Support\NumberToWords;

if (!function_exists('toPersianNumber')) {
    function toPersianNumber($value) { return Converter::toPersian($value); }
}

if (!function_exists('toEnglishNumber')) {
    function toEnglishNumber($value) { return Converter::toEnglish($value); }
}

if (!function_exists('toJalali')) {
    function toJalali($value) { return Jalali::toJalali($value); }
}

if (!function_exists('toGregorian')) {
    function toGregorian($value) { return Jalali::toGregorian($value); }
}

if (!function_exists('numberToWords')) {
    function numberToWords($value) { return NumberToWords::convert($value); }
}
