<?php

declare(strict_types=1);

namespace App\Models\User\Traits;

use App\Models\User\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait UserRelationship
{
    public function avatar()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('collection_name', static::AVATAR_MEDIA_ATTRIBUTE)
            ->where('model_type', User::class);
    }
}
