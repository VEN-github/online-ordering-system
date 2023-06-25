<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum PaymentStatus: string
{
    use ToArray;

    case PENDING = 'pending';
    case PAID = 'paid';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
}
