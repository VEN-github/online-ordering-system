<?php

declare(strict_types=1);

namespace App\DataTransferObjects\Cart;

use Spatie\LaravelData\Data;

class CartProductData extends Data
{
    public function __construct(
        public int $product_id,
        public ?int $variation_id,
        public int $quantity,
        public int $total,
    ) {
    }
}
