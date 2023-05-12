<?php

namespace App\Models\Category;

use App\Models\Category\Traits\CategoryMethod;
use App\Models\Category\Traits\CategoryRelationship;
use App\Models\Category\Traits\CategoryScope;
use App\Models\Traits\GeneratesUniqueSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
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
}