<?php

namespace App\Domains\Order\DataTransferObjects;

readonly class CreateOrderDto
{
    /**
     * @param array<OrderItemDto> $items
     */
    private function __construct(
        public array $items
    )
    {
    }

    public static function fromRequest(array $validated): self
    {
        return new self(
            items: array_map(
                function ($item) {
                    return new OrderItemDto(
                        extProductId: $item['extProductId']
                    );
                },
                $validated['items']
            )
        );
    }
}
