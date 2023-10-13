<?php

declare(strict_types=1);

namespace App\Models\Address\Traits;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait AddressRelationship
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
