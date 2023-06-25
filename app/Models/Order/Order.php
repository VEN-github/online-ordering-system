<?php

namespace App\Models\Order;

use App\Models\Order\Traits\OrderMethod;
use App\Models\Order\Traits\OrderRelationship;
use App\Models\Order\Traits\OrderScope;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUuids;
    use OrderMethod;
    use OrderRelationship;
    use OrderScope;

    protected $fillable = [
        'user_id',
        'payment_method',
        'payment_status',
        'status',
        'shipping_method',
        'total_price'
    ];
}
