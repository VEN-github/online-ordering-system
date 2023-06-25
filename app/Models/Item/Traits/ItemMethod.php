<?php

namespace App\Models\Item\Traits;

use Database\Factories\ItemFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait ItemMethod
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return ItemFactory::new();
    }
}