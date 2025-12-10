<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Product\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @extends ResourceCollection<Product> */
class ProductCollection extends ResourceCollection
{
    public $collects = ProductResource::class;
}
