<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Passwords\TokenRepositoryInterface;
use App\Auth\CustomTokenRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(TokenRepositoryInterface::class, function ($app) {
            $config = $app['config']['auth.passwords.users'];

            return new CustomTokenRepository(
                DB::connection(),
                $app['hash'],
                $config['table'],
                $config['expire'],
                $app['config']['app.key'],
                Str::random(40)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //
    }
}
