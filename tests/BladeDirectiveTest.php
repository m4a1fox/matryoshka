<?php

class BladeDirectiveTest extends TestCase
{
    protected $doll;

    /** @test */
    function it_sets_up_openning_cache_directive()
    {
        $directive = $this->createNewCacheDirective();

        $isCached = $directive->setUp($post = $this->makePost());

        $this->assertFalse($isCached);

        echo '<div>fragment</div>';

        $cacheFragment = $directive->tearDown();

        $this->assertEquals('<div>fragment</div>', $cacheFragment);
        $this->assertTrue($this->doll->has($post));
    }

    protected function createNewCacheDirective()
    {
        $cache = new \Illuminate\Cache\Repository(
            new \Illuminate\Cache\ArrayStore()
        );

        $this->doll = new \Matryoshka\RussianCaching($cache);

        return new \Matryoshka\BladeDirective($this->doll);
    }
}