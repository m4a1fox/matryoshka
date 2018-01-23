<?php

namespace Matryoshka;

use Illuminate\Support\Facades\Cache;

class FlushViews
{
    public function handle($request, $next)
    {
        if (app()->environment() === 'local') {
            Cache::tags('view')->flush();
        }

        return $next($request);
    }
}
