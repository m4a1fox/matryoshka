<?php

namespace Matryoshka;

use Illuminate\Support\Facades\Cache;

class FlushViews
{
    public function handle($request, $next)
    {
        Cache::tags('view')->flush();

        return $next($request);
    }
}
