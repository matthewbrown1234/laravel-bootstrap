<?php

namespace App\Domains\Order\Jobs;

use App\Domains\Order\Models\Order;
use App\Domains\Order\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class AbandonedOrderCleanupJob implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
    }

    public function handle(): void
    {
        Order::Query()
            ->whereIn('status', [OrderStatus::ABANDONED])
            ->where('updated_at', '<', now()->subHours(1))
            ->delete();
    }
}
