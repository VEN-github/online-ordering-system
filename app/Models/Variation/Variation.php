<?php

namespace App\Models\Variation;

use App\Models\Traits\GeneratesUniqueSlug;
use App\Models\Variation\Traits\VariationMethod;
use App\Models\Variation\Traits\VariationRelationship;
use App\Models\Variation\Traits\VariationScope;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    // use GeneratesUniqueSlug;
    use VariationMethod;
    use VariationRelationship;
    use VariationScope;

    protected $fillable = [
        'name',
        // 'slug',
        'options',
        // 'size',
        // 'color',
        'stock',
        // 'sku',
        'order',
        'product_id',
    ];

    protected $casts = [
        'options' => AsArrayObject::class,
    ];
}
