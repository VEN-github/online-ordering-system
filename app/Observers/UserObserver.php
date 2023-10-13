<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User\User;

class UserObserver
{
    /** Handle the User "created" event. */
    public function created(User $user): void
    {
        $user->cart()->create();
    }
}
