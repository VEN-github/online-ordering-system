<?php

namespace App\Models\Address;

use App\Models\Address\Traits\AddressMethod;
use App\Models\Address\Traits\AddressRelationship;
use App\Models\Address\Traits\AddressScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use AddressMethod;
    use AddressRelationship;
    use AddressScope;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        // 'company',
        'address',
        // 'unit',
        'city',
        'country',
        'state',
        'postal_code',
        'phone',
        'is_primary'
    ];
}
