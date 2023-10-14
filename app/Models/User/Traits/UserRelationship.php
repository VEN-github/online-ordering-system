<?php

declare(strict_types=1);

namespace App\Models\User\Traits;

use App\Models\Address\Address;
use App\Models\Cart\Cart;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait UserRelationship
{
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function avatar()
    {
        return $this->hasOne(Media::class, 'model_id')
            ->where('collection_name', static::AVATAR_MEDIA_ATTRIBUTE)
            ->where('model_type', User::class);
    }

    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }
}
