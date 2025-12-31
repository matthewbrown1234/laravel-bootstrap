<?php

namespace App\Domains\Order\Listeners;

use App\Domains\Order\Events\OrderCompletedEvent;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Models\OrderStatus;
use Illuminate\Support\Facades\Log;

class OrderCompletedListener
{
    public function __construct()
    {
    }


    public function handle(OrderCompletedEvent $event): void
    {
        Log::debug('Handling Order completed event for order: '
            . $event->id . ' which was completed at '
            . $event->completedAt->format('Y-m-d H:i:s') . '...');
        $order = Order::query()->findOrFail($event->id);
        $order->status = OrderStatus::PROCESSING;
        $order->save();
        Log::debug('Order completed event handled successfully for order: ' . $order->id);
    }
}
