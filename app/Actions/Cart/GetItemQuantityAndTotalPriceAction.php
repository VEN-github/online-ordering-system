<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\DataTransferObjects\Cart\GetItemQuantityAndTotalPriceData;
use App\Models\Cart\CartItem;
use App\Models\Product\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class GetItemQuantityAndTotalPriceAction
{
    use AsAction;

    public function handle(Product|CartItem $item, int $quantity): GetItemQuantityAndTotalPriceData
    {
        if ($item instanceof Product) {
            $total = (int) $item->orig_price * $quantity;
        } else {
            $quantity = (int) $item->quantity + $quantity;
            $total = (int) $item->total + (int) $item->product->orig_price;
        }

        return new GetItemQuantityAndTotalPriceData(
            $quantity,
            $total
        );
    }
}
