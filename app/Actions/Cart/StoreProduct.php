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
        ?Variation $variation,
        int $quantity = 1,
    ): void
    {
        $existingProduct = $cart->products()
            ->where('product_id', $product->id)
            ->when(
                filled($variation),
                fn ($query) => $query->where('variation_id', $variation->id)
            )
            ->first();

        if ($existingProduct) {
            $existingProduct->update([
                'quantity' => (int) $existingProduct->pivot->quantity + $quantity,
                'total' => (int) $existingProduct->pivot->total + (int) $existingProduct->orig_price,
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
