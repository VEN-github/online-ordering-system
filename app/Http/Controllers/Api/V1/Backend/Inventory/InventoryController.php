<?php

namespace App\Http\Controllers\Api\V1\Backend\Inventory;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\InventoryRequest;
use App\Http\Resources\Api\Backend\InventoryResource;
use App\Models\Inventory\Inventory;
use App\Models\Product\Product;
use App\Models\Variation\Variation;

class InventoryController extends BaseController
{
    public function store(InventoryRequest $request)
    {
        try {
            $inventory = Inventory::create($request->validated());
            $inventory = $inventory->loadMissingRelationships();
            $product = Product::findOrFail($inventory->product_id);

            if ($inventory->variation_id) {
                $variation = Variation::findOrFail($inventory->variation_id);

                $variation->increment('stock', $inventory->added_stock);

                $product->update([
                    'stocks' => NULL
                ]);
            } else {
                if (! is_null($product->stocks)) {
                    $product->increment('stocks', $inventory->added_stock);
                } else {
                    $product->update([
                        'stocks' => $inventory->added_stock
                    ]);
                }
            }

            return $this->success(
                    config('general.messages.model.created'),
                    InventoryResource::make($inventory->fresh()->load('product', 'variation'))
                );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
