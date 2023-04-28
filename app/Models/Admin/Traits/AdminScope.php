<?php

namespace App\Models\Admin\Traits;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Builder;

trait AdminScope
{
    public function scopeDecrypt(Builder $query, bool $enable = true): void
    {
        self::$isDecryptRowDisabled = $enable ? false : true;
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
