<?php

namespace App\Domains\Order\Events;

use App\Domains\Order\Models\Order;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCompletedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Order $order
    )
    {
    }
}
