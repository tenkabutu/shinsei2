<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        //
        Blade::directive('hour', function ($expression) {
            return "<?php echo ($expression)->format('G'); ?>";
        });
        Blade::directive('minutes', function ($expression) {
            return "<?php echo ($expression)->format('i'); ?>";
        });
    }
}
