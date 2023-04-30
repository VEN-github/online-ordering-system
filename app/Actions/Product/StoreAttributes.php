<?php

namespace App\Actions\Product;

use App\Models\Product\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreAttributes
{
    use AsAction;

    public function handle(Product $product, array $values): void
    {
        $attributes = [];

        $product->attributes()->delete();

        foreach ($values as $indexFromAttributes => $attribute) {
            if (array_key_exists('options', $attribute)) {
                foreach ($attribute['options'] as $indexFromOptions => $option) {
                    if (array_key_exists('name', $attribute)) {
                        $attributes[] = [
                            'name' => $attribute['name'],
                            'option' => $option,
                            'position' => $indexFromAttributes,
                            'order' => $indexFromOptions,
                        ];
                    }
                }
            }
        }

        if ($attributes) {
            $product
                ->attributes()
                ->createMany($attributes);
        }
    }
}
