<?php

declare(strict_types=1);

namespace App\Models\Admin\Traits;

use App\Models\Admin\Admin;

trait AdminMethod
{
    public static function findByEmail(string $email): ?Admin
    {
        return config('ciphersweet.enabled')
            ? self::whereBlind('email', 'email_index', $email)
                ->decrypt(false)
                ->first()
            : self::where('email', $email)
                ->first();
    }
}
