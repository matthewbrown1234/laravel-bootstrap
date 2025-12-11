<?php

namespace App\Domains\Order\DataTransferObjects;

readonly class OrderItemDto
{
    public function __construct(
        public string $extProductId
    )
    {
    }
}
