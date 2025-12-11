<?php

namespace App\Domains\Order\Http\Resources;

use App\Domains\Order\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Order
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
            'id' => $this->id,
            'status' => $this->status,
            'invoiceId' => $this->order_number,
            'subTotal' => $this->whenHas($this->getSubTotal()),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
