<?php

namespace App\Enums;

use App\Enums\Traits\ToArray;

enum ShippingMethod: string
{
    use ToArray;

    case STANDARD = 'standard';
    case EXPRESS = 'express';
}
