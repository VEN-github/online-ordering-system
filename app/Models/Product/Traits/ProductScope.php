<?php

namespace App\Models\Product\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ProductScope
{
    public function scopeEagerLoadRelationships(Builder $query): Builder
    {
        return $query->with(get_class_methods(ProductRelationship::class));
    }
}
