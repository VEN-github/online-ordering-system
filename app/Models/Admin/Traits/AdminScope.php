<?php

declare(strict_types=1);

namespace App\Models\Admin\Traits;

use App\Models\Admin\Admin;
use Illuminate\Database\Eloquent\Builder;

trait AdminScope
{
    public function scopeDecrypt(Builder $query, bool $enable = true)
    {
        self::$isDecryptRowDisabled = $enable ? false : true;
    }

    public static function scopeFindByEmail(Builder $query, string $email): ?Admin
    {
        return config('ciphersweet.enabled')
            ? self::whereBlind('email', 'email_index', $email)
                ->decrypt(false)
                ->first()
            : self::where('email', $email)
                ->first();
    }
}
