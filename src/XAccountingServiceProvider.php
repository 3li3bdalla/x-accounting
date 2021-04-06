<?php

namespace Ali3bdalla\XAccounting;

use Ali3bdalla\XAccounting\Core\EntryCore;
use Ali3bdalla\XAccounting\Facade\XAccountingEntry;
use Illuminate\Support\ServiceProvider;

class XAccountingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('x-accounting-entry', function ($app, $args) {
            return new EntryCore(...$args);
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/x-accounting.php' => config_path('x-accounting.php'),
            __DIR__ . '/migrations/' => database_path('migrations')
        ], 'x-accounting');
        $this->mergeConfigFrom(
            __DIR__ . '/config/x-accounting.php', 'x-accounting.php'
        );
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
    }
}
