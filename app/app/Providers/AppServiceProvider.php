<?php

declare(strict_types=1);

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Blade;
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
        Filament::serving(function () {
            Filament::registerViteTheme('resources/css/app.css');

            Filament::registerRenderHook(
                'footer.start',
                fn (): string => Blade::render('Copyright &copy; IMC Dispamsanau 2022'),
            );

            Filament::registerUserMenuItems([
                UserMenuItem::make()
                    ->label(__('Change Password'))
                    ->url(route('filament.pages.change-password'))
                    ->icon('heroicon-s-cog'),
                // ...
            ]);
        });
    }
}
