<?php

use Dolly\RussianCaching;

class RussianCachingTest extends TestCase
{
    /** @test */
    function it_caches_the_given_key()
    {
        $post = $this->makePost();

        $cache = new RussianCaching(new \Illuminate\Cache\Repository(new \Illuminate\Cache\ArrayStore));
        $cache->put($post, '<div>view fragment</div>');

        $this->assertTrue($cache->has($post->getCacheKey()));
        $this->assertTrue($cache->has($post));
    }
}