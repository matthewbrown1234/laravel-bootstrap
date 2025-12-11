<?php

namespace App\Domains\Order\Http\Resources;

use App\Domains\Order\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Order
 *  Resource for the Order model
 * @property Order $resource
 *
 * */
class OrderDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $orderItems = $this->whenLoaded('orderItems', fn() => OrderItemResource::collection($this->orderItems));
        return [
            'id' => $this->id,
            'orderNumber' => $this->order_number,
            'subTotal' => optional($this->orderItems)?->sum('price'),
            'invoices' => $this->whenLoaded('invoices', fn() => InvoiceResource::collection($this->invoices)),
            'orderItems' => $orderItems,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
