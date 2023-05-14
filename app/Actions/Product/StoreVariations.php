<?php

namespace App\Actions\Product;

use App\Models\Product\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreVariations
{
    use AsAction;

    public function handle(Product $product, array $values): void
    {
        $variations = [];

        $product->variations()->delete();

        foreach ($values as $index => $variation) {
            $variation['order'] = $index;
            $variations[] = $variation;
        }

        if ($variations) {
            $product
                ->variations()
                ->createMany($variations);
        }
    }
}
