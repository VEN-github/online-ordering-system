<?php

namespace App\Models\Order\Traits;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait OrderMethod
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return OrderFactory::new();
    }

    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
        );
    }

    protected function shippingPrice(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value * 100,
        );
    }

    // protected function refId(): Attribute
    // {
    //     $random = rand(50000, 99999);

    //     if (static::whereRefId($random)->first()) {
    //         $random = rand(100000, 1000000000);
    //     }

    //     // $latestOrder = static::orderBy('id', 'DESC')->first();
    //     // $count = $latestOrder ? $latestOrder->id : 0;

    //     return Attribute::make(
    //         // get: fn ($value) => '#'. (string) $value,
    //         set: fn ($value) => $random
    //         // set: fn ($value) => '#'.str_pad($count + 1, 8, "0", STR_PAD_LEFT),
    //         // set: fn ($value) => $value . now()->toDateString(),
    //     );
    // }
}
