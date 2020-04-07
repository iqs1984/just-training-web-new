<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Model\Sport;

class AppServiceProvider extends ServiceProvider {
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {

        // sport saving
        Sport::saving(function ($model) {
            $sports = Sport::whereName($model->name)->where("id", "!=", $model->id)->first();
            if ($sports) {
                throw new Exception("This sport already exits");
            }
        });

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
