<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Models\Popup;
use Illuminate\Support\Facades\URL;
use App\Observers\ProductObserver;
use App\Observers\PopupObserver;
use App\Models\Order;
use App\Observers\OrderObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
        Popup::observe(PopupObserver::class);
        Order::observe(OrderObserver::class);

         if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
