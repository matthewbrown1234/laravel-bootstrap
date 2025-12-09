<?php

namespace App\Product\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Requests\SearchPaginationRequest;
use App\Product\Models\Product;
use App\Product\Requests\StoreProductRequest;
use App\Product\Requests\UpdateProductRequest;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function search(SearchPaginationRequest $request)
    {
        $pagination = $request->pagination();
        $paginatedProducts = Product::paginate(
            perPage: $pagination->perPage,
            page: $pagination->page,
        );

//        return response()-> json($paginatedProducts);
        return $this->respond($paginatedProducts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
