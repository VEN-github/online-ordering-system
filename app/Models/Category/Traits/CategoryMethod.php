<?php

declare(strict_types=1);

namespace App\Models\Category\Traits;

use App\Models\Category\Category;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;

trait CategoryMethod
{
    use HasFactory;
    use InteractsWithMedia;

    protected static function newFactory(): Factory
    {
        return CategoryFactory::new();
    }

    protected static function getImageCollection(): string
    {
        return static::IMAGE_COLLECTION ?? '';
    }

    public function loadMissingRelationships(): Category
    {
        return static::loadMissing(get_class_methods(CategoryRelationship::class));
    }

    public function registerMediaCollections(): void
    {
        $acceptedImageMimeTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $disk = 'public-category-photos';

        $this->addMediaCollection(static::getImageCollection())
            ->acceptsMimeTypes($acceptedImageMimeTypes)
            ->useDisk($disk);
    }
}
