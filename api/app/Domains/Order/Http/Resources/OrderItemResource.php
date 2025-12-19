<?php

namespace App\Domains\Order\Http\Resources;

use App\Domains\Order\Models\OrderItem;
use App\Domains\Product\Utils\ProductUtils;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin OrderItem */
class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'formattedPrice' => ProductUtils::getFormattedPrice($this->price),
            'extProductId' => $this->ext_product_id,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
