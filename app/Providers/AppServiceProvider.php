<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Aplikasi;
use App\Models\Kontak;
use App\Models\Logo;
use App\Models\Sampul;
use App\Models\Sosmed;

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
        // Hanya untuk partial footer agar tidak perlu menambah di tiap controller
        View::composer('partials.footer', function ($view) {
            $view->with([
                'aplikasi' => Aplikasi::all(),
                'kontak' => Kontak::first(),
                'logo' => Logo::first(),
                'sampul' => Sampul::first(),
                'sosmed' => Sosmed::first(),
            ]);
        });

        view()->composer('*', function ($view) {
            $view->with([
                'logo' => Logo::first(),
                'sampul' => Sampul::first(),
            ]);
        });
    }
}
