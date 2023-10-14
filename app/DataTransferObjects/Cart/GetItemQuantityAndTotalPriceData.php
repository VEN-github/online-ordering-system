<?php

declare(strict_types=1);

namespace App\Actions\DataTransferObjects\Cart;

use Spatie\LaravelData\Data;

class GetItemQuantityAndTotalPriceData extends Data
{
    public function __construct(
        public int $quantity,
        public int $total
    ) {
    }
}
