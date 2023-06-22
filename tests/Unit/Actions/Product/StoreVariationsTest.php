<?php

declare(strict_types=1);

use App\Actions\Product\StoreVariations;
use App\Models\Product\Product;
use App\Models\Variation\Variation;

it('can_store_product_variations', function () {
    $product = Product::factory()->create();
    $variations = Variation::factory()->count(3)->make()->toArray();

    StoreVariations::run(
        $product,
        $variations
    );

    $this->assertCount(
        count($variations),
        $product->variations()->get()
    );
});

it('can_destroy_product_variations', function () {
    $product = Product::factory()
        ->has(Variation::factory()->count(6))
        ->create();

    StoreVariations::run(
        $product,
        []
    );

    $this->assertCount(
        0,
        $product->variations()->get()
    );
});
