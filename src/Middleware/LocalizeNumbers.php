<?php

namespace Zare\LaravelPersian\Middleware;

use Closure;
use DOMDocument;
use DOMXPath;

class LocalizeNumbers
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (
            app()->getLocale() === 'fa' &&
            strpos($response->headers->get('Content-Type'), 'text/html') !== false
        ) {
            $content = $response->getContent();

            libxml_use_internal_errors(true);

            $doc = new DOMDocument();
            $doc->loadHTML('<?xml encoding="utf-8" ?>' . $content, LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED);

            $xpath = new DOMXPath($doc);

            // فقط متن‌ها بدون script و style
            foreach ($xpath->query('//text()[not(ancestor::script) and not(ancestor::style)]') as $textNode) {
                $textNode->nodeValue = $this->convertNumbers($textNode->nodeValue);
            }

            $response->setContent($doc->saveHTML());
            libxml_clear_errors();
        }

        return $response;
    }

    private function convertNumbers($string): string
    {
        static $english = null;
        static $persian = null;

        if ($english === null) {
            $english = range(0, 9);
            $persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        }

        return str_replace($english, $persian, $string);
    }
}
