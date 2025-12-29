<?php

namespace App\Domains\Order\Jobs;

use App\Domains\Order\Models\Order;
use App\Domains\Order\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LockedOrderCleanupJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct()
    {
    }

    public function handle(): void
    {
        Order::Query()
            ->whereIn('status', [OrderStatus::LOCKED])
            ->where('updated_at', '<', now()->subHours(10))
            ->update(['status' => OrderStatus::ABANDONED]);
    }
}
