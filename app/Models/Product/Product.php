<?php

namespace App\Models\Product;

use App\Models\Product\Traits\ProductMethod;
use App\Models\Product\Traits\ProductRelationship;
use App\Models\Product\Traits\ProductScope;
use App\Models\Traits\GeneratesUniqueSlug;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;

class Product extends Model implements HasMedia
{
    use GeneratesUniqueSlug;
    use ProductMethod;
    use ProductRelationship;
    use ProductScope;

    protected $fillable = [
        'name',
        'slug',
        'is_featured',
        'is_active',
        'description',
        'category_id',
        'price',
        'discounted_price',
        'standard_shipping_price',
        'express_shipping_price',
        'supplier_id',
    ];

    protected const IMAGE_COLLECTION = 'images';
}
