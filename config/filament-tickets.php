<?php

return [
    'broadcast' => [
        'driver' => env('BROADCAST_DRIVER', 'pusher'),
    ],
    
    'notifications' => [
        'mail' => [
            'enabled' => true,
            'template' => 'filament-tickets::mail.ticket-updated',
        ],
    ],
    
    'permissions' => [
        'create_ticket' => 'create ticket',
        'view_ticket' => 'view ticket',
        'update_ticket' => 'update ticket',
        'delete_ticket' => 'delete ticket',
    ],
]; 