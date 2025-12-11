<?php

namespace Database\Factories\Domains\Order\Models;

use App\Domains\Order\Models\Order;
use App\Domains\Order\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Symfony\Component\Uid\Ulid;

/** @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domains\Order\Models\OrderItem> */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1000, 1_000_000_0000),
            'ext_product_id' => Ulid::generate(),
        ];
    }
}
