<?php

namespace App\Models\Order\Traits;

use Database\Factories\OrderFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait OrderMethod
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return OrderFactory::new();
    }
}
