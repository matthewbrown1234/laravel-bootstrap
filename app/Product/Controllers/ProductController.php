<?php

namespace App\Product\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Requests\SearchPaginationRequest;
use App\Product\Models\Product;
use App\Product\Requests\StoreProductRequest;
use App\Product\Requests\UpdateProductRequest;
use App\Product\Resources\ProductCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchPaginationRequest $request): ProductCollection
    {
        $products = Product::query()->paginate(
            perPage: $request->getPerPage(),
            page: $request->getPage(),
        );

        return new ProductCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): Response|JsonResponse
    {
        // Not implemented yet. Validation captured for OpenAPI via Form Request.
        return $this->respond([
            'message' => 'Creating products is not implemented.',
        ], 501);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): Response|JsonResponse
    {
        return $this->respond($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): Response|JsonResponse
    {
        // Not implemented yet. Validation captured for OpenAPI via Form Request.
        return $this->respond([
            'message' => 'Updating products is not implemented.',
        ], 501);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): Response|JsonResponse
    {
        $product->delete();

        return $this->respond(null, 204);
    }
}
