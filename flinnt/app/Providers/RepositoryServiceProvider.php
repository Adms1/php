<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProductRepository::class, \App\Repositories\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AuthorRepository::class, \App\Repositories\AuthorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PublisherRepository::class, \App\Repositories\PublisherRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\VendorRepository::class, \App\Repositories\VendorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BoardRepository::class, \App\Repositories\BoardRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StandardRepository::class, \App\Repositories\StandardRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LanguageRepository::class, \App\Repositories\LanguageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\InstitutionRepository::class, \App\Repositories\InstitutionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AttributeRepository::class, \App\Repositories\AttributeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SubjectRepository::class, \App\Repositories\SubjectRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CartRepository::class, \App\Repositories\CartRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BooksetRepository::class, \App\Repositories\BooksetRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\TagRepository::class, \App\Repositories\TagRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderRepository::class, \App\Repositories\OrderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\HomeRepository::class, \App\Repositories\HomeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ReportRepository::class, \App\Repositories\ReportRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CourierRepository::class, \App\Repositories\CourierRepositoryEloquent::class);
        //:end-bindings:
    }
}
