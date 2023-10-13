<?php

declare(strict_types=1);

namespace App\Actions\Cart;

use App\Models\Cart\Cart;
use App\Models\Product\Product;
use App\Models\Variation\Variation;
use Lorisleiva\Actions\Concerns\AsAction;
use Exception;

class StoreProduct
{
    use AsAction;

    public function handle(
        Cart $cart,
        Product $product,
        int $quantity = 1,
        ?int $variationId = null
    ) {
        $existingProduct = $cart->products()
            ->where('product_id', $product->id)
            ->where('variation_id', $variationId)
            ->first();

        if ($existingProduct) {
            return $cart->products()->updateExistingPivot($existingProduct->id, [
                'quantity' => $existingProduct->pivot->quantity + $quantity,
                'total' => $existingProduct->pivot->total + $existingProduct->orig_price,
            ]);
        }

        if ($variationId) {
            $variation = Variation::find($variationId);

            if ( ! $variation) {
                throw new Exception('Ooops! Product not found.');
            }
        }

        $cart->products()->attach($product, [
            'variation_id' => $variationId,
            'quantity' => $quantity,
            'total' => $product->orig_price * $quantity,
        ]);
    }
}
