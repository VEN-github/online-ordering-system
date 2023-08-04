<?php

declare(strict_types=1);

namespace App\Models\Category\Traits;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait CategoryRelationship
{
    public function image(): HasOne
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('collection_name', static::getImageCollection())
            ->where('model_type', static::class);
    }
}
