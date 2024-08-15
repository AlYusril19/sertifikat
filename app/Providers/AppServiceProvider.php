<?php

namespace App\Providers;

use App\Models\Peserta;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function ($view) {
            $jumlahPesertaTanpaDokumen = Peserta::doesntHave('fileDokumen')->count();
            $view->with('jumlahPesertaTanpaDokumen', $jumlahPesertaTanpaDokumen);
        });
    }
}
