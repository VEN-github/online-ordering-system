<?php

declare(strict_types=1);

namespace App\Models\Cart\Traits;

use App\Models\Cart\Cart;
use Database\Factories\CartFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait CartMethod
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return CartFactory::new();
    }

    public function loadMissingRelationships(): Cart
    {
        return static::loadMissing(get_class_methods(CartRelationship::class));
    }
}
