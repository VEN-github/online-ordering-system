<?php

declare(strict_types=1);

namespace App\Models\Admin;

use App\Models\Admin\Traits\AdminMethod;
use App\Models\Admin\Traits\AdminRelationship;
use App\Models\Admin\Traits\AdminScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;
use Spatie\MediaLibrary\HasMedia;

class Admin extends Authenticatable implements CipherSweetEncrypted, HasMedia
{
    use AdminMethod;
    use AdminRelationship;
    use AdminScope;
    use HasApiTokens;

    public const ACCESS_TOKEN = 'api-admin';
    public const AVATAR_MEDIA_ATTRIBUTE = 'avatar';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
