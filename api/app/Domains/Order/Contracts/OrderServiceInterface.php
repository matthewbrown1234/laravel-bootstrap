<?php

namespace App\Domains\Order\Contracts;

use App\Domains\Order\DataTransferObjects\CreateOrderDto;
use App\Domains\Order\Models\Order;

interface OrderServiceInterface
{
    public function createOrder(CreateOrderDto $orderItems): Order;
    public function cancelOrder(string $orderId): Order;
}
