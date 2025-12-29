<?php

namespace App\Domains\Order\Jobs;

use App\Domains\Order\Models\Order;
use App\Domains\Order\Models\OrderItem;
use App\Domains\Order\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class AbandonedOrderCleanupJob implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
    }

    public function handle(): void
    {
        Log::debug('Cleaning up abandoned orders...');
        $count = Order::Query()
            ->with(["invoices", "orderItems"])
            ->whereIn('status', [OrderStatus::ABANDONED])
            ->where('updated_at', '<', now()->subHours(1))
            ->delete();
        if($count > 0){
            Log::info('Cleaned up '.$count.' abandoned orders');
        }
        Log::debug('Cleaning up done');
    }
}
