<?php

namespace App\Domains\Order\Listeners;

use App\Domains\Order\Events\OrderCompletedEvent;
use App\Domains\Order\Models\OrderStatus;
use Illuminate\Support\Facades\Log;

class OrderCompletedListener
{
    public function __construct()
    {
    }

    public function handle(OrderCompletedEvent $event): void
    {
        Log::debug('Handling Order completed event for order: ' . $event->order->id . '...');
        $order = $event->order;
        $order->status = OrderStatus::PROCESSING;
        $order->save();
        Log::debug('Order completed event handled successfully for order: ' . $order->id);
    }
}
