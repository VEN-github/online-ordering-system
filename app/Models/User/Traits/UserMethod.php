<?php

declare(strict_types=1);

namespace App\Models\User\Traits;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use ParagonIE\CipherSweet\EncryptedRow;
use ParagonIE\CipherSweet\BlindIndex;
use Spatie\LaravelCipherSweet\Concerns\UsesCipherSweet;
use Spatie\MediaLibrary\InteractsWithMedia;

trait UserMethod
{
    use HasFactory;
    use InteractsWithMedia;
    use UsesCipherSweet;

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
        if ( ! static::$isDecryptRowDisabled) {
            $this->setRawAttributes(
                static::$cipherSweetEncryptedRow->decryptRow($this->getAttributes()),
                true
            );
        }
    }

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(static::AVATAR_MEDIA_ATTRIBUTE)
            ->singleFile()
            ->useDisk('public-avatars');
    }
}
