<?php

namespace App\Domains\Order\Http\Resources;

use App\Domains\Order\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @extends JsonResource<Order>
 *     Resource for the Order model
 * @property Order $resource
 *
 */
class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'invoiceId' => $this->resource->order_number,
            'createdAt' => $this->resource->created_at,
            'updatedAt' => $this->resource->updated_at,
        ];
    }
}
