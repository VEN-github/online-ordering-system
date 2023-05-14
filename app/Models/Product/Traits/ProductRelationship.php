<?php

namespace App\Models\Product\Traits;

use App\Models\Attribute\Attribute;
use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Supplier\Supplier;
use App\Models\Variation\Variation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait ProductRelationship
{
    public function attributes(): HasMany
    {
        return $this->hasMany(Attribute::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function highlightImages(): HasMany
    {
        return $this->hasMany(Media::class, 'model_id')
            ->where('collection_name', static::getHighlightImageCollection())
            ->where('model_type', static::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Media::class, 'model_id')
            ->where('collection_name', static::getImageCollection())
            ->where('model_type', static::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function variations(): HasMany
    {
        return $this->hasMany(Variation::class);
    }
}
