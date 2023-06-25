<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum OrderStatus: string
{
    use ToArray;

    case PENDING = 'pending';
    case PROCESSING = 'processing';
    case CONFIRMED = 'confirmed';
    case SHIPPED = 'shipped';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';
}
