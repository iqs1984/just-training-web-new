<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        Validator::extend('mobile', function ($title, $value) {
            return preg_match('/^\+[\d-]*$/', $value);
        });

        Validator::replacer('mobile', function () {
            return 'Invalid Mobile No';
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
