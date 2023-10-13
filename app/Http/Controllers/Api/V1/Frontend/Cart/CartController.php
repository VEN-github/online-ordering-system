<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\Cart;

use App\Actions\Cart\StoreProduct;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Frontend\Cart\CartRequest;
use App\Http\Resources\Api\Frontend\CartResource;
use App\Models\Cart\Cart;
use App\Models\Product\Product;
use App\Models\Variation\Variation;
use Exception;

class CartController extends BaseController
{
    public function store(CartRequest $request)
    {
        try {
            /** @var \App\Models\Cart\Cart $cart */
            $cart = auth()->user()->cart;

            /** @var \App\Models\Product\Product $product */
            $product = Product::findOrFail($request->input('id'));

            /** @var \App\Models\Variantion\Variantion|null $variation */
            $variation = Variation::find($request->input('variation_id', null));

            StoreProduct::run(
                $cart,
                $product,
                $variation,
                $request->input('quantity', 1)
            );

            $cart = $cart->loadMissing([
                'user',
                'products'
            ]);

            return $this->success(
                config('general.messages.request.success'),
                CartResource::make($cart)
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function show()
    {
        try {
            /** @var \App\Models\Cart\Cart $cart */
            $cart = auth()->user()
                ->cart
                ->load('products');

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
