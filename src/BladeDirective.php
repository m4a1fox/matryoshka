<?php

namespace Dolly;

class BladeDirective
{
    protected $keys = [];
    protected $cache;

    public function __construct(RussianCaching $cach)
    {
        $this->cache = $cach;

    }

    public function setUp($model)
    {
        ob_start();
        $this->keys[] = $key = $model->getCacheKey();

        return $this->cache->has($key);
    }

    public function tearDown()
    {
        return $this->cache->put(array_pop($this->keys), ob_get_clean());
    }
}
