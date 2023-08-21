<?php

namespace App\Observers;

use App\Models\Cart\Cart;
use App\Models\User\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $user->cart()->create();
    }
}
