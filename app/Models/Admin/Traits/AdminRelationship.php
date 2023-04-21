<?php

declare(strict_types=1);

namespace App\Models\Admin\Traits;

use App\Models\Admin\Admin;
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
