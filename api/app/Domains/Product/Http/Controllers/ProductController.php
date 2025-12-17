<?php

namespace App\Domains\Product\Http\Controllers;

use App\Contracts\SortBy;
use App\Domains\Product\Http\Requests\PageableProductRequest;
use App\Domains\Product\Http\Requests\SearchProductsRequest;
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
                ->applySortBy($request->getSortBy(), new SortBy(col: 'created_at', dir: 'desc'))
                ->paginate(
                    perPage: $request->getPerPage(),
                    page: $request->getPage(),
                )
        );
    }

    public function search(SearchProductsRequest $request)
    {
        return new ProductCollection(
            Product::query()
                ->whereIn('id', $request->getIdFilters())
                ->applySortBy($request->getSortBy(), new SortBy(col: 'created_at', dir: 'desc'))
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
