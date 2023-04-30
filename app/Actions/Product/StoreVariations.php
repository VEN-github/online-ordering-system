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
        $originalKeys = ['price', 'stock', 'code'];

        $product->variations()->delete();

        foreach ($values as $index => $variation) {
            $originalAttributes = array_intersect_key(
                $variation,
                array_flip($originalKeys)
            );

            $originalAttributes['order'] = $index;

            $extraAttributes = array_diff_key(
                $variation,
                array_flip($originalKeys)
            );

            $variations[] = array_merge(
                ['attributes' => $extraAttributes],
                $originalAttributes
            );
        }

        if ($variations) {
            $product
                ->variations()
                ->createMany($variations);
        }
    }
}
