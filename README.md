# Zare Laravel Persian 🇮🇷

![GitHub release](https://img.shields.io/github/v/release/Digitaltoman/zare-laravel-persian)
![GitHub issues](https://img.shields.io/github/issues/Digitaltoman/zare-laravel-persian)
![GitHub license](https://img.shields.io/github/license/Digitaltoman/zare-laravel-persian)
![Laravel](https://img.shields.io/badge/Laravel-8+-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?logo=php&logoColor=white)

> یک پکیج جامع و هوشمند برای **فارسی‌سازی کامل پروژه‌های لاراول** ✨  
> A complete Laravel package for **Persian localization**, including **number conversion, Jalali date, validation, and more**.

---

## ✨ ویژگی‌ها | Features

| ویژگی (Feature) | توضیح (Description) | وضعیت (Status) |
|-----------------|----------------------|----------------|
| 🔢 **تبدیل خودکار اعداد** | Persian/English number auto conversion | ✅ فعال |
| 📅 **تاریخ شمسی (جلالی)** | Full support for Jalali calendar | ✅ فعال |
| ✅ **اعتبارسنجی ایرانی** | National code, Mobile, Postal Code validation | ✅ فعال |
| 🔤 **اعداد به حروف** | Number-to-Words (Persian money & text) | ✅ فعال |
| ⚡ **نصب خودکار** | Auto-registration (no manual config needed) | ✅ فعال |
| 🌐 **چندزبانه** | Multi-language (Persian + English) | ✅ فعال |

---

## 🚀 نصب | Installation

### روش ۱: Composer (توصیه‌شده) | Method 1: Composer (Recommended)

```bash
composer require zare/laravel-persian

---
### روش ۲: نصب دستی | Method 2: Manual Installation

git clone https://github.com/Digitaltoman/zare-laravel-persian.git
---
### اضافه کردن به composer.json:
Add to your composer.json:

{
    "require": {
        "zare/laravel-persian": "*"
    }
}


---

## ⚙️ تنظیمات | Configuration

انتشار فایل کانفیگ:
Publish config file:

php artisan vendor:publish --provider="Zare\\LaravelPersian\\ZareServiceProvider" --tag="zare-persian-config"

فایل config/zare-persian.php شامل تنظیمات زیر است:

return [
    'enabled' => true,
    'auto_convert' => true,
    'locales' => ['fa', 'persian', 'فارسی'],

    'middleware' => [
        'normalize_input' => true,   // Convert Persian input → English
        'localize_output' => true,   // Convert English output → Persian
    ],

    'validation' => [
        'auto_register' => true,
    ],
];


---

##📦 استفاده | Usage

### 1. تبدیل اعداد | Number Conversion

use Zare\LaravelPersian\Support\Converter;

$persian = Converter::englishToPersian('1234567890'); // ۱۲۳۴۵۶۷۸۹۰
$english = Converter::persianToEnglish('۱۲۳۴۵۶۷۸۹۰'); // 1234567890

### 2. تاریخ شمسی | Jalali Dates

use Zare\LaravelPersian\Support\Jalali;

echo Jalali::toJalali(now(), 'Y/m/d'); // ۱۴۰۲/۱۰/۱۵
echo Jalali::fromJalali('1402/10/15'); // 2024-01-05

### 3. اعتبارسنجی ایرانی | Validation

$request->validate([
    'mobile' => 'required|persian_mobile',
    'national_code' => 'required|national_code',
    'postal_code' => 'required|persian_postal_code',
]);

### 4. اعداد به حروف | Number To Words

use Zare\LaravelPersian\Support\NumberToWords;

echo NumberToWords::toPersianWords(1250000);
// "یک میلیون و دویست و پنجاه هزار"

echo NumberToWords::toPersianMoney(1250000);
// "یک میلیون و دویست و پنجاه هزار تومان"


---

## 🖥️ استفاده در Blade | Blade Usage

<p>تعداد کاربران: {{ to_persian_numbers($userCount) }}</p>
<p>تاریخ امروز: {{ to_jalali(now()) }}</p>
<p>مبلغ: {{ number_to_persian_words($amount) }}</p>


---

## 🤝 مشارکت | Contributing

1. Fork the project


2. Create your feature branch (git checkout -b feature/new-feature)


3. Commit your changes (git commit -m 'Add new feature')


4. Push to the branch (git push origin feature/new-feature)


5. Open a Pull Request




---

## 💖 اسپانسرها | Sponsors

این پروژه با حمایت گروه راه و چاره توسعه داده می‌شود.
If you’d like to sponsor this project, please contact us.


---

### 📞 پشتیبانی | Support

### 🌐 وبسایت: rahochare.ir

### 📧 ایمیل: support@rahochare.ir

### 🐛 گزارش باگ‌ها: GitHub Issues



---

## 📄 لایسنس | License

این پروژه تحت لایسنس MIT منتشر شده است.
This project is released under the MIT license.


---

## توسعه داده شده با ❤️ برای جامعه برنامه‌نویسان ایرانی 🇮🇷

---

