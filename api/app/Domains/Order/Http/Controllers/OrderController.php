<?php

namespace App\Domains\Order\Http\Controllers;

use App\Contracts\SortBy;
use App\Domains\Order\Contracts\OrderServiceInterface;
use App\Domains\Order\Http\Requests\CancelOrderRequest;
use App\Domains\Order\Http\Requests\CreateOrderRequest;
use App\Domains\Order\Http\Requests\PageableOrderRequest;
use App\Domains\Order\Http\Resources\OrderCollection;
use App\Domains\Order\Http\Resources\OrderDetailResource;
use App\Domains\Order\Models\Order;

class OrderController
{
    public function __construct(protected OrderServiceInterface $orderService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PageableOrderRequest $request)
    {
        return new OrderCollection(
            Order::query()
                ->applySortBy($request->getSortBy(), new SortBy(col: 'created_at', dir: 'desc'))
                ->withSubtotal()
                ->paginate(
                    perPage: $request->getPerPage(),
                    page: $request->getPage(),
                )
        );
    }

    public function show(string $orderId)
    {
        return new OrderDetailResource(
            Order::query()
                ->withSubtotal()
                ->with(['invoices', 'orderItems',])
                ->findOrFail($orderId)
        );
    }

    public function store(CreateOrderRequest $request)
    {
        return new OrderDetailResource($this->orderService->createOrder($request->toDto()));
    }

    public function create(CreateOrderRequest $request)
    {
        return new OrderDetailResource($this->orderService->createOrder($request->toDto()));
    }

    public function cancel(CancelOrderRequest $request)
    {
        return new OrderDetailResource($this->orderService->cancelOrder($request->getOrderId()));
    }

    public function complete(string $orderId)
    {
        return new OrderDetailResource($this->orderService->completeOrdered($orderId));
    }
}
