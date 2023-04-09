<?php

namespace App\Models\Image\Traits;

use Illuminate\Database\Eloquent\Relations\MorphTo;

trait ImageRelationship
{
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}