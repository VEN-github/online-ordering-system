<?php

namespace App\Models\Order\Traits;

use Illuminate\Database\Eloquent\Builder;

trait OrderScope
{
    public function scopeEagerLoadRelationships(Builder $query): Builder
    {
        return $query->with(array_merge(get_class_methods(OrderRelationship::class), ['items.product.highlightImages']));
    }
}
