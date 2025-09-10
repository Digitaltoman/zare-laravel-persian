<?php

namespace Zare\LaravelPersian\Middleware;

use Closure;

class NormalizeNumbers
{
    public function handle($request, Closure $next)
    {
        $persianNumbers = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $englishNumbers = range(0, 9);
        $persianChars = ['ي','ك'];
        $farsiChars = ['ی','ک'];

        $input = $request->all();

        array_walk_recursive($input, function (&$value) use ($persianNumbers, $englishNumbers, $persianChars, $farsiChars) {
            if (is_string($value)) {
                $value = str_replace($persianNumbers, $englishNumbers, $value);
                $value = str_replace($persianChars, $farsiChars, $value);
            }
        });

        $request->merge($input);

        return $next($request);
    }
}
