<?php

declare(strict_types=1);

namespace App\Models\Country;

use App\Models\Country\Traits\CountryMethod;
use App\Models\Country\Traits\CountryRelationship;
use App\Models\Country\Traits\CountryScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use CountryMethod;
    use CountryRelationship;
    use CountryScope;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
    ];
}
