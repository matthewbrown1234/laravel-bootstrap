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
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'invoices' => $this->whenLoaded('invoices', fn() => InvoiceResource::collection($this->invoices))
        ];
    }
}
