<?php

namespace Unite\Tags;

use Illuminate\Support\ServiceProvider;
use Route;
use Unite\Tags\Console\Commands\Install;

class TagsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        Route::patterns([
            'id'    => '^\d+$',
            'model' => '^\d+$',
        ]);

        $this->commands([
            Install::class,
        ]);

        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

        if ($this->app->runningInConsole()) {
            if (! class_exists('CreateTagTables')) {
                $timestamp = date('Y_m_d_His', time());
                $this->publishes([
                    __DIR__.'/../database/migrations/create_tag_tables.php.stub' => database_path('migrations/'.$timestamp.'_create_tag_tables.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
