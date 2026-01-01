<?php

namespace App\Domains\Fulfillment\Listeners;

use App\Domains\Fulfillment\Events\ReadyForFulfillmentEvent;
use App\Domains\Order\Events\OrderCompletedEvent;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class OrderCompletedListener implements ShouldQueue, ShouldHandleEventsAfterCommit
{
    public string $queue = 'fulfillment';

    public function __construct()
    {
    }

    public function handle(OrderCompletedEvent $event): void
    {
        Log::debug('Handling Order in fulfillment for order: '
            . $event->id . ' which was completed at '
            . $event->completedAt->format('Y-m-d H:i:s') . '...');
        // TODO: grab order items and dispatch event to create fulfillment orders
        ReadyForFulfillmentEvent::dispatch($event->id);
    }
}
