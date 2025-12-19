<?php

use App\Domains\Product\Models\Product;

it('print env', function () {
     var_dump(getenv());
});

it('returns a single product by id', function () {
     var_dump(getenv());
    $product = Product::factory()->createOne([
        'name' => 'Prod A',
        'description' => 'Desc A',
        'price' => 1999,
    ]);

    $response = $this->getJson("/api/products/{$product->getKey()}");

    $response->assertOk()
        ->assertJson([
            'data' => [
                'id' => $product->getKey(),
                'name' => 'Prod A',
                'description' => 'Desc A',
                'price' => 1999,
                'createdAt' => $product->created_at->toISOString(),
            ],
        ])
        ->assertJsonStructure([
            'data' => [
                'id', 'name', 'description', 'price', 'createdAt', 'updatedAt',
            ],
        ]);
});
