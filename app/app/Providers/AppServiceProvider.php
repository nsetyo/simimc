<?php

declare(strict_types=1);

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     */
    public function boot(): void
    {
        Filament::pushMeta([
            new HtmlString('<link rel="icon" href="logo.svg" type="image/svg" />'),
        ]);
    }
}
