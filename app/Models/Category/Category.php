<?php

declare(strict_types=1);

namespace App\Models\Category;

use App\Models\Category\Traits\CategoryMethod;
use App\Models\Category\Traits\CategoryRelationship;
use App\Models\Category\Traits\CategoryScope;
use App\Models\Traits\GeneratesUniqueSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;

class Category extends Model implements HasMedia
{
    use GeneratesUniqueSlug;
    use CategoryMethod;
    use CategoryRelationship;
    use CategoryScope;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected const IMAGE_COLLECTION = 'image';
}
