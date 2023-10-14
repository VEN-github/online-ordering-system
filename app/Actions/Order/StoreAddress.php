<?php

declare(strict_types=1);

namespace App\Actions\Order;

use App\DataTransferObjects\Order\AddressData;
use App\Models\Order\Order;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreAddress
{
    use AsAction;

    public function handle(Order $order)
    {
        if ($order->is_saved) {
            auth()->user()
                ->addresses()
                ->create(
                    (new AddressData(
                        $order->first_name,
                        $order->last_name,
                        $order->address,
                        $order->city,
                        $order->country,
                        $order->state,
                        $order->postal_code,
                        $order->phone
                    ))->toArray()
                );
        }
    }
}
