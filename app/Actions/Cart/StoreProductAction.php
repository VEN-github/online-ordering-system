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
        Cart $cart,
        Product $product,
        ?Variation $variation = null,
        int $quantity = 1,
    ): mixed
    {
        $existingProduct = $cart->products()
            ->where('product_id', $product->id)
            ->when(
                filled($variation),
                fn ($query) => $query->where('variation_id', $variation->id)
            )
            ->first();

        $cartProductData = GetItemQuantityAndTotalPriceAction::run(
                $existingProduct ?? $product,
                $quantity
            )
            ->toArray();

        if ($existingProduct) {
            return $existingProduct->update($cartProductData);
        }

        return $cart->products()->create(
            array_merge(['variation_id' => $variation->id], $cartProductData)
        );
    }
}
