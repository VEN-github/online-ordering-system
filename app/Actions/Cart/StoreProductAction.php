<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\Cart\Cart;
use App\Models\Product\Product;
use App\Models\Variation\Variation;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProductAction
{
    use AsAction;

    public function handle(
        Product $product,
        ?Variation $variation = null,
        int $quantity = 1,
    ): Cart
    {
        /** @var \App\Models\Cart\Cart $cart */
        $cart = auth()->user()->cart;

        /** @var \App\Models\Cart\CartProduct|null $existingProduct */
        $existingProduct = $cart->products()
            ->where('product_id', $product->id)
            ->when(
                filled($variation),
                fn ($query) => $query->where('variation_id', $variation->id)
            )
            ->first();

        /** @var array<string, int> $cartProductData */
        $cartProductData = GetItemQuantityAndTotalPriceAction::run(
                $existingProduct ?? $product,
                $quantity
            )
            ->toArray();

        if ($existingProduct) {
            $existingProduct->update($cartProductData);
        } else {
            $cart->products()->create(
                array_merge(['variation_id' => $variation->id], $cartProductData)
            );
        }

        return $cart;
    }
}
