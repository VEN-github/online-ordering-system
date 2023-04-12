<?php

namespace App\Models\Admin\Traits;

use Illuminate\Database\Eloquent\Builder;

trait AdminScope
{
    public function scopeDecrypt(Builder $query, bool $enable = true)
    {
        self::$isDecryptRowDisabled = $enable ? false : true;
    }
}
