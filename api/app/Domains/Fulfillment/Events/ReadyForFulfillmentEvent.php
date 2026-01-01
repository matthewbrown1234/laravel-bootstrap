<?php

namespace App\Domains\Fulfillment\Events;

use Illuminate\Foundation\Events\Dispatchable;

class ReadyForFulfillmentEvent
{
    use Dispatchable;

    public function __construct(readonly string $orderId)
    {
    }
}
