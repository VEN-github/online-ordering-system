<?php

namespace App\Actions\Product;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreVariations
{
    use AsAction;

    public function handle(Product $product, mixed $values): void
    {
        if (!is_array($values)) {
            return;
        }

        DB::transaction(function () use ($product, $values) {
            $variations = [];

            $product->variations()->delete();

            foreach ($values as $index => $variation) {
                if (empty($variation)) {
                    throw new \Exception('Variation cannot be empty.');
                }

                $variation['order'] = $index;
                $variations[] = $variation;
            }

            if ($variations) {
                $product
                    ->variations()
                    ->createMany($variations);

                $product->update([
                    'sku' => NULL,
                    'stocks' => collect($variations)->sum('stock'),
                ]);
            }
        });
    }
}
