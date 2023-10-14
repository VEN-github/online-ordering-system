<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\Cart\CartProduct;
use App\Models\Product\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class GetItemQuantityAndTotalPriceAction
{
    use AsAction;

    public function handle(Product|CartProduct $item, int $quantity): GetItemQuantityAndTotalPriceData
    {
        if ($item instanceof Product) {
            $total = (int) $item->orig_price * $quantity;
        } else {
            $quantity = (int) $item->quantity + $quantity;
            $total = (int) $item->total + ((int) $item->orig_price * $quantity);
        }

        return new GetItemQuantityAndTotalPriceData(
            quantity: $quantity,
            total: $total
        );
    }
}
