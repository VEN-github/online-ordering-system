<?php

namespace App\Models\Order;

use App\Models\Order\Traits\OrderMethod;
use App\Models\Order\Traits\OrderRelationship;
use App\Models\Order\Traits\OrderScope;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use OrderMethod;
    use OrderRelationship;
    use OrderScope;

    protected $fillable = [
        'ref_id',
        'user_id',
        'email',
        'first_name',
        'last_name',
        'company',
        'address',
        'unit',
        'city',
        'country',
        'state',
        'postal_code',
        'phone',
        'payment_method',
        'payment_status',
        'status',
        'shipping_method',
        'shipping_price',
        'total_price'
    ];
}
