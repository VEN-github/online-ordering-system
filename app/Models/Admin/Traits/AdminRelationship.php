<?php

namespace App\Models\Admin\Traits;

use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait AdminRelationship
{
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
}
