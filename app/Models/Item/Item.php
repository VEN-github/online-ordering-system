<?php

declare(strict_types=1);

namespace App\Models\Item;

use App\Models\Item\Traits\ItemMethod;
use App\Models\Item\Traits\ItemRelationship;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use ItemMethod;
    use ItemRelationship;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'orig_price',
        'selling_price',
        'discounted_price',
        'total_price'
    ];
}
