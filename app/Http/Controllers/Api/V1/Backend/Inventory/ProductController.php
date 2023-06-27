<?php

namespace App\Http\Controllers\Api\V1\Backend\Inventory;

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
                        ->with('variations')
                        ->latest()
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
}
