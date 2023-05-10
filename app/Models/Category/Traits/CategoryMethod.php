<?php

namespace App\Models\Category\Traits;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait CategoryMethod
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }
}
