<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Collection;
use App\Product;
use App\Category;
use App\CategoryTrademark;



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

          $arrayCategoriesWithoutRepeating = CategoryTrademark::join('categories', 'category_id', '=', 'categories.id')
          ->select('categories.name as name_category')
          ->where('categories.status', 1)
          ->orderBy('name_category')
          ->distinct('name_category')
          ->get();
          View::share('arrayCategoriesWithoutRepeating', $arrayCategoriesWithoutRepeating);
    }
}
