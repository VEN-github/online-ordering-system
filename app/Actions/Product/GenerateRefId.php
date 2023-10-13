<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Models\Order\Order;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateRefId
{
    use AsAction;

    public function handle(): int
    {
        $orders = Order::get();
        $random = rand(50000, 99999);

        if ($orders->where('ref_id', $random)->first()) {
            $random .= count($orders);
        }

        return (int) $random;
    }
}
