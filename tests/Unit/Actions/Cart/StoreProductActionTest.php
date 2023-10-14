<?php

declare(strict_types=1);

use App\Actions\Cart\StoreProductAction;
use App\Models\Cart\Cart;
use Database\Factories\CartFactory;
use Database\Factories\ProductFactory;
use Database\Factories\UserFactory;
use Database\Factories\VariationFactory;
use Laravel\Sanctum\Sanctum;

use function PHPUnit\Framework\assertInstanceOf;

beforeEach(function () {
    Sanctum::actingAs(
        UserFactory::new()
            ->has(CartFactory::new())
            ->createOne()
    );

    $this->product = ProductFactory::new()->createOne();
});

it('can store', function () {
    $cart = StoreProductAction::run($this->product, VariationFactory::new()->createOne());

    assertInstanceOf(Cart::class, $cart);
});

it('can store non-variant', function () {
    $cart = StoreProductAction::run($this->product, null);

    assertInstanceOf(Cart::class, $cart);
});
