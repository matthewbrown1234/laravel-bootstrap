<?php

namespace Database\Seeders\Order;

use App\Domains\Order\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(10000)->create();
    }
}
