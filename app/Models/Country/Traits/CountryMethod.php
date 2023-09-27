<?php

declare(strict_types=1);

namespace App\Models\Country\Traits;

use App\Models\Country\Country;

trait CountryMethod
{
    public function loadMissingRelationships(): Country
    {
        return static::loadMissing(get_class_methods(CountryRelationship::class));
    }
}
