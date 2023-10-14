<?php

declare(strict_types=1);

use App\Actions\Order\StoreAddress;
use Database\Factories\OrderFactory;
use Database\Factories\UserFactory;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    Sanctum::actingAs(UserFactory::new()->createOne());

    $this->order = OrderFactory::new()
        ->saveAddress()
        ->createOne();
});

it('can store', function () {
    StoreAddress::run($this->order);

    expect(auth()->user()->addresses->count())->toBe(1);
});
