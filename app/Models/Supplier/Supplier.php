<?php

namespace App\Models\Supplier;

use Database\Factories\SupplierFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'name',
        'city',
        'country'
    ];

    protected static function newFactory(): Factory
    {
        return SupplierFactory::new();
    }
}
