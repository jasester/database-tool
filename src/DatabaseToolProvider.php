<?php

namespace Hnndy\DatabaseTool;

use Illuminate\Support\ServiceProvider;

class DatabaseToolProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('databasetool', function () {
           return new DatabaseTool();
        });
    }
}
