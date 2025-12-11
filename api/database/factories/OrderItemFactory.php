<?php

namespace Database\Factories;

use App\Domains\Order\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Uid\Ulid;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1000, 1_000_000_000_0000),
            'ext_product_id' => Ulid::generate(),
        ];
    }
}
