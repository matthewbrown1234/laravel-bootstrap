<?php

namespace App\Domains\Product\Http\Resources;

use App\Domains\Product\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public $collects = ProductResource::class;
}
