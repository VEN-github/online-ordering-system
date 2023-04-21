<?php

namespace App\Models\Admin;

use App\Models\Admin\Traits\AdminMethod;
use App\Models\Admin\Traits\AdminRelationship;
use App\Models\Admin\Traits\AdminScope;
use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use ParagonIE\CipherSweet\EncryptedRow;
use ParagonIE\CipherSweet\BlindIndex;
use Spatie\LaravelCipherSweet\Contracts\CipherSweetEncrypted;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements CipherSweetEncrypted, HasMedia
{
    use AdminMethod,
        AdminRelationship,
        AdminScope,
        HasApiTokens,
        HasFactory,
        InteractsWithMedia,
        UsesCipherSweet;

    const ACCESS_TOKEN = 'api-admin';
    const AVATAR_MEDIA_ATTRIBUTE = 'avatar';

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

    private static bool $isDecryptRowDisabled = false;

    public static function configureCipherSweet(EncryptedRow $encryptedRow): void
    {
        if (config('ciphersweet.enabled')) {
            $encryptedRow
                ->addField('email')
                ->addBlindIndex('email', new BlindIndex('email_index'));
        }
    }

    public function decryptRow(): void
    {
        if (! self::$isDecryptRowDisabled) {
            $this->setRawAttributes(
                static::$cipherSweetEncryptedRow->decryptRow($this->getAttributes()),
                true
            );
        }
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::AVATAR_MEDIA_ATTRIBUTE)
            ->singleFile()
            ->useDisk('public-avatars');
    }

    protected static function newFactory(): Factory
    {
        return AdminFactory::new();
    }
}
