<?php

namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\Layout\SidebarComposer;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.*', 'users.*'], SidebarComposer::class);
        View::composer(['resellers.shop.partials.mini-cart', 'resellers.cart.index', 'resellers.checkout.partials.confirm'], CartComposer::class);
    }
}
