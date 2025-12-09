<?php

namespace App\Product\Resources;

use App\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @extends JsonResource<Product>
 *
 */
class ProductResource extends JsonResource
{
    /** @return Product */
    private function model(): Product
    {
        return $this->resource;
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->model()->id,
            'name' => $this->model()->name,
            'description' => $this->model()->description,
            'price' => $this->model()->price,
            'createdAt' => $this->model()->created_at,
            'updatedAt' => $this->model()->updated_at,
        ];
    }
}
