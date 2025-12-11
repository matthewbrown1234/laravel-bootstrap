<?php

namespace App\Domains\Product\Services;

use App\Domains\Product\Contracts\ProductServiceInterface;
use App\Domains\Product\Models\Product;

class ProductService implements ProductServiceInterface
{
    /**
     * @inheritDoc
     */
    public function findProducts(array $ids): array
    {
        return Product::query()->findMany($ids)->all();
    }
}
