<?php

namespace Descom\Supervisor\Support;

class Helper
{
    public static function artisan(): string
    {
        if (config('app.env') === 'testing') {
            return __DIR__.'/../../vendor/bin/testbench';
        }

        return base_path('artisan');
    }

    public static function artisanBaseName(): string
    {
        return basename(Helper::artisan());
    }
}
