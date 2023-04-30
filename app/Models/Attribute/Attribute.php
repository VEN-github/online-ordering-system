<?php

namespace App\Models\Attribute;

use App\Models\Attribute\Traits\AttributeMethod;
use App\Models\Attribute\Traits\AttributeRelationship;
use App\Models\Attribute\Traits\AttributeScope;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use AttributeMethod;
    use AttributeRelationship;
    use AttributeScope;

    protected $fillable = [
        'name',
        'option',
        'position',
        'order',
        'product_id',
    ];
}
