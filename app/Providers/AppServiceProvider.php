<?php

namespace App\Providers;

use App\Models\Billing;
use App\Models\Order;
use App\Models\Detail;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap('partials.user-orders');

        view()->composer(['user-orders-cfm', 'cart-checkout'], function ($view) {
            $userId = Auth::user()->id;
            $cartCollection = \Cart::session($userId)->getContent();
            $userDetails =  Detail::where('userId', Auth::user()->id)->get();
            $ip = '203.117.125.53'; //For static IP address get
            $orders = Order::where('userId', Auth::user()->id)->get();
            // $ip = request()->ip(); //Dynamic IP address get
            $data = \Location::get($ip);
            $view
                ->with('cartCollection', $cartCollection)
                ->with('userDetails', $userDetails)
                ->with('data', $data)
                ->with('orders', $orders);
        });

        view()->composer('user-orders-summary', function ($view) {
            $billId = Billing::latest()->first();
            $view->with('billId', $billId);
        });

        view()->composer(['partials.user-orders', 'user-orders-summary'], function ($view) {
            $orders = Order::where('userId', Auth::user()->id)->paginate(5);
            $view->with('orders', $orders);
        });
    }
}
