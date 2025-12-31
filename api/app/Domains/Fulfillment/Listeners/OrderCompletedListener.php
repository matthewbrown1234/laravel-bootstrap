<?php

namespace App\Domains\Fulfillment\Listeners;

use App\Domains\Order\Events\OrderCompletedEvent;
use Illuminate\Support\Facades\Log;

class OrderCompletedListener
{
    public function __construct()
    {
    }

    public function handle(OrderCompletedEvent $event): void
    {
        Log::debug('Handling Order in fulfillment for order: '
            . $event->id . ' which was completed at '
            . $event->completedAt->format('Y-m-d H:i:s') . '...');
    }
}
