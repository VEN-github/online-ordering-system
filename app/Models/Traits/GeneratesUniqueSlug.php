<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait GeneratesUniqueSlug
{
    protected static function bootGeneratesUniqueSlug(): void
    {
        static::creating(function ($model) {
            $model->slug = $model->generateUniqueSlug($model->slug);
        });
    }

    protected function generateUniqueSlug(?string $slug = null): string
    {
        if (empty(trim($slug))) {
            $slug = Str::random(4);
        }

        $slug = Str::slug($slug);

        $count = static::where('slug', 'LIKE', '%' . $slug)->count();

        if ($count > 0) {
            $randomString = Str::random(30);
            $slug .= '-' . substr($randomString,0,4) . ($count + 1);
        }

        return $slug;
    }
}
