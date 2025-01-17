<?php

namespace YourVendor\FilamentTickets;

use Filament\Support\Assets\Asset;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use YourVendor\FilamentTickets\Livewire\TicketChat;

class FilamentTicketsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-tickets');

        $this->publishes([
            __DIR__ . '/../config/filament-tickets.php' => config_path('filament-tickets.php'),
        ], 'filament-tickets-config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'filament-tickets-migrations');

        Livewire::component('ticket-chat', TicketChat::class);
    }

    public function register(): void
    {
        $this->app->singleton(FilamentTicketsPlugin::class, function () {
            return FilamentTicketsPlugin::make();
        });

        $this->mergeConfigFrom(
            __DIR__ . '/../config/filament-tickets.php',
            'filament-tickets'
        );
    }
} 