<?php

namespace Matryoshka;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MatryoshkaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('cache', function ($expression) {
            return "<?php if (! app('Matryoshka\BladeDirective')->setUp({$expression})) { ?>";
        });

        Blade::directive('endcache', function () {
            return "<?php } echo app('Matryoshka\BladeDirective')->tearDown() ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BladeDirective::class, function () {
            return new BladeDirective(
                new RussianCaching(app('cache.store'))
            );
        });
    }
}
