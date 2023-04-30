<?php

namespace App\Models\Product\Traits;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;

trait ProductMethod
{
    use HasFactory;
    use InteractsWithMedia;

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    protected static function getImageCollection(): string
    {
        return static::IMAGE_COLLECTION ?? '';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(static::getImageCollection())
            ->acceptsMimeTypes(['image/jpeg'])
            ->useDisk('public-product-photos');
    }
}
