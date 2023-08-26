<?php

namespace App\Actions\Order;

use App\Models\Order\Order;
use App\Models\User\User;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreAddress
{
    use AsAction;

    public function handle(User $user, Order $order)
    {
        if ($order->is_saved) {
            $user->addresses()->create([
                'first_name' => $order->first_name,
                'last_name' => $order->last_name,
                'address' => $order->address,
                'city' => $order->city,
                'country' => $order->country,
                'state' => $order->state,
                'postal_code' => $order->postal_code,
                'phone' => $order->phone,
                'is_primary' => 0
            ]);
        }
    }
}