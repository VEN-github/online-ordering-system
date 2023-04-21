<?php

namespace App\Models\Admin\Traits;

use App\Models\Admin\Admin;
use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait AdminRelationship
{
    public function avatar()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('collection_name', self::AVATAR_MEDIA_ATTRIBUTE)
            ->where('model_type', Admin::class);
    }
}
