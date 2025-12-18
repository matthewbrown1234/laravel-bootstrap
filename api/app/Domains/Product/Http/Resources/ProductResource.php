<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use NumberFormatter;

/**
 * @mixin Product
 * @property Product $resource
 */
class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $numberFormatter = new \NumberFormatter("en_US", \NumberFormatter::CURRENCY);
        $numberFormatter->setAttribute(NumberFormatter::ROUNDING_MODE, NumberFormatter::ROUND_HALFEVEN);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'formattedPrice' => $numberFormatter
                ->formatCurrency($this->price / 10000, "USD"),
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
        ];
    }
}
