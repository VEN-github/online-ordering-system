<?php

namespace App\Collections;

use App\Models\Variation\Variation;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class VariationCollection
{
    /**
     * @param AnonymousResourceCollection|Variation[] $variations
     */
    public static function make(AnonymousResourceCollection $variations): Collection
    {
        $collection = [];

        $variations = $variations->sortBy('order');

        foreach ($variations as $variation) {

            foreach ($variation->attributes as $key => $option) {
                $value[$key] = $option;
            }

            $value = array_merge(
                $value,
                [
                    'price' => $variation->price ?? '',
                    'stock' => $variation->stock ?? '',
                    'code' => $variation->code ?? '',
                    'created_at' => $variation->created_at ?? '',
                    'updated_at' => $variation->updated_at ?? '',
                ]
            );

            $collection[] = $value;
        }

        return collect($collection);
    }
}
