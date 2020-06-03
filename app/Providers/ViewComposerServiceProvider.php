<?php

namespace App\Providers;

use App\Faq;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\Admin\HeaderComposer;
use App\Http\View\Composers\Admin\SidebarComposer as AdminSidebarComposer;
use App\Http\View\Composers\Admin\AsideComposer as AdminAsideComposer;
use App\Http\View\Composers\SettingComposer;
use App\Http\View\Composers\Reseller\SidebarComposer as ResellerSidebarComposer;
use App\Http\View\Composers\Reseller\AsideComposer as ResellerAsideComposer;

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
        View::composer('faqs', function ($view) {
            $view->with('faqs', Faq::all());
        });

        // View::composer(['layouts.*', 'reseller.shop.header'], HeaderComposer::class);
        View::composer(['admin.*', 'layouts.*'], AdminAsideComposer::class);
        View::composer(['admin.*', 'layouts.*'], AdminSidebarComposer::class);
        View::composer(['reseller.layout'], ResellerSidebarComposer::class);
        View::composer(['reseller.layout'], ResellerAsideComposer::class);
        View::composer(['reseller.products.partials.mini-cart', 'reseller.cart.*', 'reseller.checkout.*'], CartComposer::class);

        View::composer(['welcome', 'contact-form', 'layouts.*', 'admin.aside.*', 'components.layouts.header', 'components.layouts.footer', 'reseller.layout', 'reseller.products.layout', 'reseller.checkout.content', 'reseller.products.product', 'livewire.charge-calculator'], SettingComposer::class);
    }
}
