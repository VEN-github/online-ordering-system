<?php

namespace App\Models\Variation;

use App\Models\Variation\Traits\VariationMethod;
use App\Models\Variation\Traits\VariationRelationship;
use App\Models\Variation\Traits\VariationScope;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use VariationMethod;
    use VariationRelationship;
    use VariationScope;

    protected $fillable = [
        'code',
        'attributes',
        'price',
        'stock',
        'order',
        'product_id',
    ];

    protected $casts = [
        'attributes' => AsArrayObject::class,
    ];
}
