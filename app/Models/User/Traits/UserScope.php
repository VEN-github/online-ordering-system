<?php

declare(strict_types=1);

namespace App\Models\User\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UserScope
{
    public function scopeDecrypt(Builder $query, bool $enable = true): Builder
    {
        static::$isDecryptRowDisabled = $enable ? false : true;

        return $query;
    }

    public static function scopeFilterByEmail(Builder $query, string $email): Builder
    {
        return config('ciphersweet.enabled')
            ? $query
                ->whereBlind('email', 'email_index', $email)
                ->decrypt(false)
            : $query->where('email', $email);
    }
}
