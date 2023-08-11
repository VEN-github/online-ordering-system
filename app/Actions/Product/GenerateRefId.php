<?php

namespace App\Actions\Product;

use App\Models\Order\Order;
use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateRefId
{
    use AsAction;

    public function handle(): string
    {
        $latestOrder = Order::orderBy('created_at', 'DESC')->first();
        $count = $latestOrder ? $latestOrder->id : 0;

        return '#'.str_pad($count + 1, 8, "0", STR_PAD_LEFT);
    }
}
