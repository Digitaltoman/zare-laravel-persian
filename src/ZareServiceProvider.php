<?php

namespace Zare\LaravelPersian;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Zare\LaravelPersian\Middleware\LocalizeNumbers;
use Zare\LaravelPersian\Middleware\NormalizeNumbers;

class ZareServiceProvider extends ServiceProvider
{
    public function register()
    {
        // ثبت singleton برای converter
        $this->app->singleton('zare.converter', function () {
            return new \Zare\LaravelPersian\Support\Converter;
        });

        // ثبت singleton برای jalali
        $this->app->singleton('zare.jalali', function () {
            return new \Zare\LaravelPersian\Support\Jalali;
        });

        // ثبت میدلورها
        $this->app->singleton(LocalizeNumbers::class, function () {
            return new LocalizeNumbers;
        });

        $this->app->singleton(NormalizeNumbers::class, function () {
            return new NormalizeNumbers;
        });
    }

    public function boot()
    {
        // ثبت میدلورها به صورت global
        $this->registerGlobalMiddleware();

        // ثبت validation rules
        $this->registerValidationRules();

        // تشخیص خودکار زبان برای فعال کردن تبدیل اعداد
        $this->detectLanguage();
    }

    protected function registerGlobalMiddleware()
    {
        $kernel = $this->app->make(Kernel::class);
        
        // اضافه کردن میدلورها به صورت global
        $kernel->pushMiddleware(NormalizeNumbers::class); // اول برای ورودی
        $kernel->pushMiddleware(LocalizeNumbers::class); // بعد برای خروجی
    }

    protected function registerValidationRules()
    {
        // ثبت اتوماتیک validation rules
        $validator = $this->app['validator'];
        
        $validator->extend('persian_mobile', function ($attribute, $value, $parameters, $validator) {
            return \Zare\LaravelPersian\Support\Validation::validateMobile($value);
        }, 'شماره موبایل معتبر نیست');

        $validator->extend('national_code', function ($attribute, $value, $parameters, $validator) {
            return \Zare\LaravelPersian\Support\Validation::validateNationalCode($value);
        }, 'کد ملی معتبر نیست');

        $validator->extend('persian_postal_code', function ($attribute, $value, $parameters, $validator) {
            return \Zare\LaravelPersian\Support\Validation::validatePostalCode($value);
        }, 'کد پستی معتبر نیست');
    }

    protected function detectLanguage()
    {
        // اگر زبان فارسی است، تبدیل اعداد را فعال کن
        $this->app->booted(function () {
            $currentLocale = app()->getLocale();
            config(['zare-persian.enabled' => in_array($currentLocale, ['fa', 'persian', 'فارسی'])]);
        });
    }
}
