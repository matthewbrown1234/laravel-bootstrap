<?php

namespace App\Domains\Order\Http\Controllers;

use App\Domains\Order\Http\Resources\OrderCollection;
use App\Domains\Order\Http\Resources\OrderDetailResource;
use App\Domains\Order\Models\Order;
use App\Http\Requests\SearchPaginationRequest;

class OrderController
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchPaginationRequest $request)
    {
        return new OrderCollection(
            Order::query()->paginate(
                perPage: $request->getPerPage(),
                page: $request->getPage(),
            )
        );
    }

    public function show(Order $order)
    {
        return new OrderDetailResource($order->load('invoices'));
    }
}
