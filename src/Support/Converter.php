<?php

namespace Zare\LaravelPersian\Support;

class Converter
{
    public static function toPersian($value)
    {
        return str_replace(range(0, 9), ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'], $value);
    }

    public static function toEnglish($value)
    {
        $value = str_replace(['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'], range(0, 9), $value);
        return str_replace(['ي','ك'], ['ی','ک'], $value);
    }
}
