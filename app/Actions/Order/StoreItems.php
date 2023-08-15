<?php

namespace App\Actions\Order;

use App\Models\Item\Item;
use App\Models\Order\Order;
use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreItems
{
    use AsAction;

    public function handle(Order $order, array $items)
    {
        $collectedItems = [];

        if (count($items) > 0) {
            foreach ($items as $key => $item) {
                $model = new Item();
                $model->product_id = $item['product_id'];
                $model->quantity = $item['quantity'];
                $model->total_price = $item['total_price'];

                $collectedItems[] = $model;
            }

            $order->items()->saveMany($collectedItems);
        }
    }
}
