<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\DataTransferObjects\Cart\CartItemData;
use App\Models\Cart\Cart;
use App\Models\Product\Product;
use App\Models\Variation\Variation;
use Lorisleiva\Actions\Concerns\AsAction;

class AddCartItemAction
{
    use AsAction;

    public function handle(
        Product $product,
        ?Variation $variation = null,
        int $quantity = 1,
    ): Cart {
        /** @var \App\Models\Cart\Cart $cart */
        $cart = auth()->user()->cart;

        /** @var \App\Models\Cart\CartItem|null $cartItem */
        $cartItem = $cart->items()
            ->where('item_id', $product->id)
            ->when(
                filled($variation),
                fn ($query) => $query->where('variation_id', $variation->id)
            )
            ->first();

        /** @var \App\DataTransferObjects\Cart\GetItemQuantityAndTotalPriceData $cartItemData */
        $cartItemData = GetItemQuantityAndTotalPriceAction::run(
            $cartItem ?? $product,
            $quantity
        );

        if (filled($cartItem)) {
            $cartItem->update($cartItemData->toArray());

            return $cart;
        }

        $cart->items()->create(
            (new CartItemData(
                item_id: $product->id,
                variation_id: filled($variation)
                    ? $variation->id
                    : null,
                quantity: $cartItemData->quantity,
                total: $cartItemData->total
            ))->toArray()
        );

        return $cart;
    }
}
