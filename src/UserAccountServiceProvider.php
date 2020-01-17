<?php

namespace Rir\UserAccountNotify;

use Illuminate\Support\ServiceProvider;

class UserAccountServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/user_account.php' => config_path('user_account.php')
        ]);
    }
}
