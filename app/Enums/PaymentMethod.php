<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum PaymentMethod: string
{
    use ToArray;

    case CREDIT_CARD = 'credit card';
    case PAYPAL = 'paypal';
    case CASH_ON_DELIVERY = 'cash on delivery';
}
