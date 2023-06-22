<?php

namespace App\Models\Product\Traits;

use App\Models\Product\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;

trait ProductMethod
{
    use HasFactory;
    use InteractsWithMedia;

    protected static function getHighlightImageCollection(): string
    {
        return static::HIGHLIGHT_IMAGE_COLLECTION ?? '';
    }

    protected static function getImageCollection(): string
    {
        return static::IMAGE_COLLECTION ?? '';
    }

    public function loadMissingRelationships(): Product
    {
        return static::loadMissing(get_class_methods(ProductRelationship::class));
    }

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

    public function registerMediaCollections(): void
    {
        $acceptedImageMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $disk = 'public-product-photos';

        $this->addMediaCollection(static::getImageCollection())
            ->acceptsMimeTypes($acceptedImageMimeTypes)
            ->useDisk($disk);

        $this->addMediaCollection(static::getHighlightImageCollection())
            ->acceptsMimeTypes($acceptedImageMimeTypes)
            ->useDisk($disk);
    }
}
