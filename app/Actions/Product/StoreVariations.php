<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Exception;

class StoreVariations
{
    use AsAction;

    public function handle(Product $product, mixed $values): void
    {
        DB::transaction(function () use ($product, $values) {
            $variations = [];

            $product->variations()->delete();

            if (is_null($values) || ! is_array($values)) {
                return;
            }

            foreach ($values as $index => $variation) {
                if (empty($variation)) {
                    throw new Exception('Variation cannot be empty.');
                }

                $variations[] = [
                    'size' => $variation['size'],
                    'color' => $variation['color'],
                    'stock' => $variation['stock'],
                    'sku' => $variation['sku'],
                    'order' => $index,
                ];
            }

            if ($variations) {
                $product
                    ->variations()
                    ->createMany($variations);

                $product->update([
                    'sku' => null,
                    'stocks' => null,
                ]);
            }
        });
    }
}
