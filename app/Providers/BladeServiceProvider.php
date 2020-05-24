<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class BladeServiceProvider extends ServiceProvider
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
        Blade::directive('iverified', function ($exp) {
            return "<?php if(request()->user()->verified_at !== NULL): ?>";
        });
    
        Blade::directive('endiverified', function ($exp) {
            return "<?php endif; ?>";
        });
    }
}
