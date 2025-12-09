<?php

namespace App\Product\Controllers;

use App\Http\Controllers\ApiController;
use App\Http\Requests\SearchPaginationRequest;
use App\Product\Models\Product;
use App\Product\Resources\ProductCollection;
use App\Product\Resources\ProductResource;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchPaginationRequest $request): ProductCollection
    {
        return new ProductCollection(
            Product::query()->paginate(
                perPage: $request->getPerPage(),
                page: $request->getPage(),
            ));
    }

//    public function store(StoreProductRequest $request): Response|JsonResponse
//    {
//        // Not implemented yet. Validation captured for OpenAPI via Form Request.
//        return $this->respond([
//            'message' => 'Creating products is not implemented.',
//        ], 501);
//    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }

//    public function update(UpdateProductRequest $request, Product $product): Response|JsonResponse
//    {
//        // Not implemented yet. Validation captured for OpenAPI via Form Request.
//        return $this->respond([
//            'message' => 'Updating products is not implemented.',
//        ], 501);
//    }

//    public function destroy(Product $product): Response|JsonResponse
//    {
//        $product->delete();
//
//        return $this->respond(null, 204);
//    }
}
