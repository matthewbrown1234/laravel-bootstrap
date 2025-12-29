<?php

use App\Domains\Order\Jobs\AbandonedOrderCleanupJob;
use App\Domains\Order\Jobs\CancelledOrderCleanupJob;
use App\Domains\Order\Jobs\LockedOrderCleanupJob;

Schedule::job(new AbandonedOrderCleanupJob())->everyThirtyMinutes();
Schedule::job(new LockedOrderCleanupJob())->everyThirtyMinutes();
Schedule::job(new CancelledOrderCleanupJob())->everyThirtyMinutes();
