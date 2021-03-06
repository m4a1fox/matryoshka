<?php

namespace Matryoshka;

use Illuminate\Contracts\Cache\Repository as Cache;

class RussianCaching
{
    protected $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function put($key, $fragment)
    {
        return $this->cache
            ->tags('view')
            ->rememberForever($this->normalizeCacheKey($key), function () use ($fragment) {
                return $fragment;
            });
    }

    public function has($key)
    {
        return $this->cache
            ->tags('view')
            ->has($this->normalizeCacheKey($key));
    }

    private function normalizeCacheKey($key)
    {
        return $key instanceof \Illuminate\Database\Eloquent\Model ? $key->getCacheKey() : $key;
    }
}