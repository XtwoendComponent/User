<?php namespace Xtwoend\Component\User;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{	
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        $this->loadTranslationsFrom(__DIR__ . '/resource/lang', 'user');

        $this->publishes([
            __DIR__.'/resources/database/migrations' => base_path('database/migrations'),
        ], 'migration');

        $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views'),
        ], 'view');
        
        require __DIR__ . '/Http/routes.php';
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config.php', 'auth'
        );
    }

}