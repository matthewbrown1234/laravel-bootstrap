<?php

namespace Database\Factories\Domains\Order\Models;

use App\Domains\Order\Models\Invoice;
use App\Domains\Order\Models\Order;
use App\Domains\Order\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Uid\Ulid;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => Ulid::generate()
        ];
    }

    public function configure(): OrderFactory
    {
        return $this->afterCreating(function (Order $order) {
            $order->invoices()->save(Invoice::factory()->make());
            $order->orderItems()->saveMany(OrderItem::factory()->count($this->faker->numberBetween(1, 20))->make());
        });
    }
}
