<?php

namespace App\Models\Inventory\Traits;

use App\Models\Product\Product;
use App\Models\Variation\Variation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait InventoryRelationship
{
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variation(): BelongsTo
    {
        return $this->belongsTo(Variation::class);
    }
}
