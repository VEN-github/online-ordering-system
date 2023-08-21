<?php

declare(strict_types=1);

namespace App\Models\Cart\Traits;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait CartRelationship
{
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('id', 'variation_id', 'quantity', 'total')
            ->withTimestamps();
    }
}
