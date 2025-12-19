<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Product\Models\Product;
use App\Domains\Product\Utils\ProductUtils;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Product
 * @property Product $resource
 */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'formattedPrice' => ProductUtils::getFormattedPrice($this->price),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
