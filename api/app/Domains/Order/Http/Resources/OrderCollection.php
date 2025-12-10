<?php

namespace App\Domains\Order\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Domains\Order\Models\Order */
class OrderCollection extends ResourceCollection
{
    public $collects = OrderResource::class;
}
