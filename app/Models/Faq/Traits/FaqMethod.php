<?php

namespace App\Models\Faq\Traits;

use Database\Factories\FaqFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

trait FaqMethod
{
    use HasFactory;

    protected static function newFactory(): Factory
    {
        return FaqFactory::new();
    }
}
