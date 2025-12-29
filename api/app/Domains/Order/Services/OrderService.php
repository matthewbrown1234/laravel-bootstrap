<?php

namespace App\Domains\Order\Services;

use App\Domains\Order\Contracts\OrderServiceInterface;
use App\Domains\Order\DataTransferObjects\CreateOrderDto;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Models\OrderItem;
use App\Domains\Order\Models\OrderStatus;
use App\Domains\Product\Contracts\ProductServiceInterface;
use App\Domains\Product\Models\Product;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Symfony\Component\Uid\Ulid;

class OrderService implements OrderServiceInterface
{
    public function __construct(protected ProductServiceInterface $productService)
    {
    }

    /**
     * @param CreateOrderDto $request
     * @return Order
     * @throws \Throwable
     */
    public function createOrder(CreateOrderDto $request): Order
    {
        if (empty($request->items)) {
            throw new InvalidArgumentException('Order Items cannot be empty');
        }

        $products = $this->productService->findProducts(array_map(fn($i) => $i->extProductId, $request->items));

        if (count($products) !== count($request->items)) {
            throw new InvalidArgumentException('Invalid Product Id');
        }

        return DB::transaction(function () use ($products) {
            $order = new Order();
            $order->status = OrderStatus::LOCKED;
            $order->order_number = Ulid::generate();
            $order->save();

            // todo: create taxes here.

            $order
                ->orderItems()
                ->forceCreateMany(
                    array_map(
                        function ($p) {
                            $orderItem = new OrderItem();
                            $orderItem->ext_product_id = $p->id;
                            $orderItem->name = $p->name;
                            $orderItem->price = $p->price;
                            return $orderItem->toArray();
                        },
                        $products
                    )
                );

            return $order;
        });
    }

    public function cancelOrder(string $orderId): Order
    {
        $order = Order::query()->findOrFail($orderId);
        $order->status = OrderStatus::CANCELLED;
        $order->save();
        return $order;
    }

    public function completeOrdered(string $orderId): Order
    {
        $order = Order::query()
            ->find($orderId)
            ->where('status', '=', OrderStatus::LOCKED)
            ->firstOrFail();
        $order->status = OrderStatus::ORDERED;
        return $order;
    }
}
