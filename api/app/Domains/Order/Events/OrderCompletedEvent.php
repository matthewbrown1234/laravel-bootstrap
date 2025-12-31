<?php

namespace App\Domains\Order\Events;

use Carbon\Carbon;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderCompletedEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public readonly string $id,
        public readonly Carbon $completedAt
    )
    {
    }
}
