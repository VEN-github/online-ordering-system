<?php

namespace App\Models\Admin;

use App\Models\Admin\Traits\AdminRelationship;
use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use AdminRelationship;
    use HasApiTokens, HasFactory;

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

    const ACCESS_TOKEN = 'api-admin';

    protected static function newFactory(): Factory
    {
        return AdminFactory::new();
    }
}
