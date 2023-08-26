<?php

namespace App\Http\Controllers\Api\V1\Frontend\Product;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Api\Backend\ProductResource;
use App\Models\Product\Product;

class ProductController extends BaseController
{
    public function index()
    {
        try {
            $products = ProductResource::collection(
                    Product::query()
                        ->eagerLoadRelationships()
                        ->whereIsActive(true)
                        ->latest()
                        ->get()
                );

            return $this->success(
                    config('general.messages.request.success'),
                    $products->paginate($this->paginate)
                );
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function getFeatured()
    {
        try {
            $products = ProductResource::collection(
                    Product::query()
                        ->eagerLoadRelationships()
                        ->inRandomOrder()
                        ->whereIsFeatured(true)
                        ->limit(4)
                        ->get()
                );

            return $this->success(
                    config('general.messages.request.success'),
                    $products
                );
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function show(string $slug)
    {
        try {
            $product = Product::query()
                ->eagerLoadRelationships()
                ->whereSlug($slug)
                ->first();

            return $product
                ? $this->success(
                        config('general.messages.request.success'),
                        ProductResource::make($product)
                    )
                : $this->error(config('general.messages.model.not_found'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
