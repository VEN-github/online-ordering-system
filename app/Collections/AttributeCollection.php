<?php

namespace App\Collections;

use App\Models\Attribute\Attribute;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;

class AttributeCollection
{
    /**
     * @param AnonymousResourceCollection|Attribute[] $attributes
     */
    public static function make(AnonymousResourceCollection $attributes): Collection
    {
        $collection = [];

        $attributes = $attributes->sortBy([
                ['position', 'asc'],
                ['order', 'asc'],
            ])
            ->groupBy('name');

        foreach ($attributes as $key => $variations) {
            $attribute = ['name' => $key];

            foreach ($variations as $index => $variation) {
                $attribute['options'][$index] = $variation->option ?? '';
            }

            $collection[] = $attribute;
        }

        return collect($collection);
    }
}
