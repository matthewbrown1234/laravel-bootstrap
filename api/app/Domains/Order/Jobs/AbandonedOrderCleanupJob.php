<?php

namespace App\Domains\Order\Jobs;

use App\Domains\Order\Models\OrderStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
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
        $count = DB::table('orders')
            ->whereIn('status', [OrderStatus::ABANDONED])
            ->where('updated_at', '<', now()->subHours(10))
            ->delete();
        if($count > 0){
            Log::info('Cleaned up '.$count.' abandoned orders');
        }
        Log::debug('Cleaning up done');
    }
}
