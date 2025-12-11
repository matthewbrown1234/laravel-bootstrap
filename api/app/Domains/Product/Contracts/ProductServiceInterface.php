<?php

namespace App\Domains\Product\Contracts;

use App\Domains\Product\Models\Product;

interface ProductServiceInterface
{
    /**
     * @param array<string> $ids
     * @return array<Product>
     */
    public function findProducts(array $ids): array;
}
