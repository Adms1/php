<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        // Custom validation for category name create/update
        Validator::extend('unique_custom', function ($attribute, $value, $parameters) {
            // Get the parameters passed to the rule
            list($table, $field, $field2, $field2Value, $field3, $field3Value) = $parameters;

            // Check the table and return true only if there are no entries matching
            // both the first field name and the user input value as well as
            // the second field name and the second field value
            $category_tree_data = DB::table('category_tree')->where('category_tree_id', $field2Value)->first();
            $category_id = $category_tree_data->child_category_id;
            return DB::table($table)->where($field, $value)->where($field2, '!=',$category_id)->where($field3, $field3Value)->count() == 0;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
    }
}
