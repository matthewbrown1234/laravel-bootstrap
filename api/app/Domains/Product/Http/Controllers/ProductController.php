<?php

namespace App\Domains\Product\Http\Controllers;

use App\Domains\Product\Http\Requests\PageableProductRequest;
use App\Domains\Product\Http\Resources\ProductCollection;
use App\Domains\Product\Http\Resources\ProductResource;
use App\Domains\Product\Models\Product;

class ProductController
{
    /**
     * Display a listing of the resource.
     */
    public function index(PageableProductRequest $request): ProductCollection
    {
        return new ProductCollection(
            Product::query()
                ->applySortBy($request->getSortBy())
                ->paginate(
                    perPage: $request->getPerPage(),
                    page: $request->getPage(),
                )
        );
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
