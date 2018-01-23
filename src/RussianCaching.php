<?php

namespace Dolly;


use Illuminate\Support\Facades\Cache;

class RussianCaching
{
    protected static $keys = [];

    public static function setUp($model)
    {
        static::$keys[] = $key = $model->getCacheKey();

        ob_start();

        return Cache::tags('view')->has($key);
    }

    public static function tearDown()
    {
        $key = array_pop(static::$keys);

        $html = ob_get_clean();

        return Cache::tags('view')->rememberForever($key, function() use ($html) {
            return $html;
        });
    }
}