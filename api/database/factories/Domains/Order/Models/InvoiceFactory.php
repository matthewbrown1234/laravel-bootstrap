<?php


namespace Database\Factories\Domains\Order\Models;

use App\Domains\Order\Models\Invoice;
use App\Domains\Order\Models\InvoiceStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Symfony\Component\Uid\Ulid;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->uuid(),
            'status' => $this->faker->randomElement(InvoiceStatus::cases()),
            'total' => $this->faker->numberBetween(100, 1_000_000_000_0000),
            'sub_total' => $this->faker->numberBetween(100, 1_000_000_000_0000),
            'external_id' => Ulid::generate(),
        ];
    }
}
