<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\Cart;

use App\Actions\Cart\StoreProduct;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Frontend\Cart\CartRequest;
use App\Http\Resources\Api\Frontend\CartResource;
use App\Models\Cart\Cart;
use App\Models\Product\Product;
use Exception;

class CartController extends BaseController
{
    public function store(CartRequest $request)
    {
        try {
            $cart = auth()->user()->cart;
            $product = Product::findOrFail($request->id);

            StoreProduct::run(
                $cart,
                $product,
                $request->input('quantity', 1),
                $request->input('variation_id', null)
            );

            $cart = $cart->loadMissingRelationships();

            return $this->success(
                config('general.messages.request.success'),
                CartResource::make($cart)
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function show()
    {
        try {
            $cart = Cart::with('products')->find(auth()->user()->id);

            return $cart
                ? $this->success(
                    config('general.messages.request.success'),
                    CartResource::make($cart)
                )
                : $this->error(config('general.messages.model.not_found'));
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
