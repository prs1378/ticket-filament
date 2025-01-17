<?php

namespace prs1378\FilamentTickets;

use Filament\Contracts\Plugin;
use Filament\Panel;
use prs1378\FilamentTickets\Resources\TicketResource;

class FilamentTicketsPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-tickets';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                TicketResource::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return new static();
    }

    public static function get(): static
    {
        return filament(app(static::class)->getId());
    }
} 
