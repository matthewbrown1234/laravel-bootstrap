<?php

namespace App\Product\Resources;

use App\Product\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @extends ResourceCollection<Product> */
class ProductCollection extends ResourceCollection
{
    public $collects = ProductResource::class;
}
