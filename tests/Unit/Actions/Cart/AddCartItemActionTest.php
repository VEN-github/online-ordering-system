<?php

declare(strict_types=1);

use App\Actions\Cart\AddCartItemAction;
use App\DataTransferObjects\Cart\CartProductData;
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

it('can add', function () {
    $cart = AddCartItemAction::run($this->product, VariationFactory::new()->createOne());

    assertInstanceOf(Cart::class, $cart);
});

it('can add non-variant', function () {
    $cart = AddCartItemAction::run($this->product);

    assertInstanceOf(Cart::class, $cart);
});

it('can update an item', function () {
    $quantity = 2;

    $productOrigPrice = (int) $this->product->orig_price;

    auth()->user()
        ->cart
        ->products()
        ->create(
            (new CartProductData(
                product_id: $this->product->id,
                variation_id: null,
                quantity: $quantity,
                total: $productOrigPrice * $quantity
            ))->toArray()
        );

    $cart = AddCartItemAction::run($this->product);

    assertInstanceOf(Cart::class, $cart);

    $items = $cart->products;

    expect($items->count())->toBe(1);

    $totalQuantity = $quantity + 1;

    expect($items->first()->quantity)->toBe($totalQuantity);

    expect($items->first()->total)->toBe($productOrigPrice * $totalQuantity);
});

it('can update an item with variation', function () {
    $this->product = ProductFactory::new()
        ->has(VariationFactory::new())
        ->createOne();

    $variation = $this->product->variations->first();

    $quantity = 5;

    $productOrigPrice = (int) $this->product->orig_price;

    auth()->user()
        ->cart
        ->products()
        ->create(
            (new CartProductData(
                product_id: $this->product->id,
                variation_id: $variation->id,
                quantity: $quantity,
                total: $productOrigPrice * $quantity
            ))->toArray()
        );

    $cart = AddCartItemAction::run(
        $this->product,
        $variation
    );

    assertInstanceOf(Cart::class, $cart);

    $items = $cart->products;

    expect($items->count())->toBe(1);

    $totalQuantity = $quantity + 1;

    expect($items->first()->quantity)->toBe($totalQuantity);

    expect($items->first()->total)->toBe($productOrigPrice * $totalQuantity);
});
