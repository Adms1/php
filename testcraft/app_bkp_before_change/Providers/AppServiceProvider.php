<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use DB;

class AppServiceProvider extends ServiceProvider
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
        // Custom validation for course subject create/update
        Validator::extend('unique_custom', function ($attribute, $value, $parameters) {
            // Get the parameters passed to the rule
            if (count($parameters) == 3) { 
                // At Time to Create
                list($table, $field2, $field2Value) = $parameters;
                // Check the table and return true only if there are no entries matching
                return DB::table($table)->where($field2, $field2Value)
                                        ->where($attribute, $value)
                                        ->count() == 0;
            }

            // At Time to Edit
            list($table, $tableKey, $tableValue, $field2, $field2Value) = $parameters;
            // Check the table and return true only if there are no entries matching
                return DB::table($table)->where($tableKey, '!=', $tableValue)
                                        ->where($attribute, $value)
                                        ->where($field2, $field2Value)
                                        ->count() == 0;
        });

        // Custom validation for board standard subject create/update
        Validator::extend('unique_bss', function ($attribute, $value, $parameters) {

            // Get the parameters passed to the rule
            if (count($parameters) == 5) { 
                // At Time to Create
                list($table, $field2, $field2Value, $field3, $field3Value) = $parameters;
                // Check the table and return true only if there are no entries matching
                return DB::table($table)->where($attribute, $value)
                                        ->where($field2, $field2Value)
                                        ->where($field3, $field3Value)
                                        ->count() == 0;
            }

            // At Time to Edit
            list($table, $tableKey, $tableValue, $field2, $field2Value, $field3, $field3Value) = $parameters;
            // Check the table and return true only if there are no entries matching
                return DB::table($table)->where($tableKey, '!=', $tableValue)
                                        ->where($attribute, $value)
                                        ->where($field2, $field2Value)
                                        ->where($field3, $field3Value)
                                        ->count() == 0;
        });
    }
}
