<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Check that all values in a given array are numeric.
         */
        Validator::extend('numeric_array', function($attribute, $value, $parameters) {
            foreach($value as $v) {
                 if( (int)$v == 0 ) return false;
            }
            return true;
        });

        /**
         * Check that all values in a given array are exist in a table.
         * @example "array_exists:categories,id"
         */
        Validator::extend('array_exists', function ($attribute, $values, $parameters) {
            $param_table = $parameters[0];
            $param_field = $parameters[1];

            foreach ($values as $value) {
                $value_found = DB::table($param_table)->where($param_field, $value)->get();
                if (!$value_found) return false;
            }

            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
