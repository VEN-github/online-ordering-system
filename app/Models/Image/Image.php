<?php

declare(strict_types=1);

namespace App\Models\Image;

use App\Models\Image\Traits\ImageRelationship;
use Database\Factories\ImageFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use ImageRelationship;
    use HasFactory;

    protected $fillable = [
        'url',
    ];

    protected static function newFactory(): Factory
    {
        return ImageFactory::new();
    }
}
