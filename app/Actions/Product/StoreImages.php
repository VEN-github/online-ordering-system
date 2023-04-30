<?php

namespace App\Actions\Product;

use App\Models\Product\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreImages
{
    use AsAction;

    public function handle(Product $product, string $collection): void
    {
        $product->clearMediaCollection($collection);

        if (request()->hasFile($collection)) {
            $product
                ->addMultipleMediaFromRequest([$collection])
                ->each(function ($fileAdder) use ($collection) {
                    $fileAdder->toMediaCollection($collection);
                });
        }
    }
}
