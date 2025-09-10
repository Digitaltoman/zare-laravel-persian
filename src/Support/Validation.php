<?php

namespace Zare\LaravelPersian\Support;

use Morilog\Jalali\Jalalian;

class Validation
{
    /**
     * بررسی شماره ملی
     */
    public static function nationalCode(string $value): bool
    {
        return preg_match('/^\d{10}$/', $value) === 1;
    }

    /**
     * بررسی شماره موبایل ایران
     */
    public static function mobile(string $value): bool
    {
        return preg_match('/^09\d{9}$/', $value) === 1;
    }

    /**
     * بررسی کد پستی ایران
     */
    public static function postalCode(string $value): bool
    {
        return preg_match('/^\d{10}$/', $value) === 1;
    }

    /**
     * بررسی تاریخ شمسی معتبر
     */
    public static function jalaliDate(string $value): bool
    {
        try {
            Jalalian::fromFormat('Y/m/d', $value);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
