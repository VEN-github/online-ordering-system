<?php

declare(strict_types=1);

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\User\Traits\UserMethod;
use App\Models\User\Traits\UserRelationship;
use App\Models\User\Traits\UserScope;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;
use Spatie\MediaLibrary\HasMedia;

class User extends Authenticatable implements CipherSweetEncrypted, HasMedia
{
    use UserMethod;
    use UserRelationship;
    use UserScope;
    use HasApiTokens;
    use Notifiable;

    public const ACCESS_TOKEN = 'api-user';
    public const AVATAR_MEDIA_ATTRIBUTE = 'avatar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
