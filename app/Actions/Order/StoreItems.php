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
                $product = Product::query()->findOrFail($item['product_id']);

                $model = new Item();
                $model->product_id = $product->id;
                $model->quantity = $item['quantity'];
                $model->orig_price = $product->orig_price;
                $model->selling_price = $product->selling_price;
                $model->discounted_price = $product->discounted_price;
                $model->total_price = $item['total_price'];

                $collectedItems[] = $model;
            }

            $order->items()->saveMany($collectedItems);
        }
    }
}
