<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\Category;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Api\Backend\ProductResource;
use App\Models\Category\Category;
use App\Models\Product\Product;
use Exception;

class ProductController extends BaseController
{
    public function index(string $category)
    {
        try {
            $category = Category::query()
                ->whereSlug($category)
                ->first();

            if (! $category) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $products = ProductResource::collection(
                Product::query()
                    ->eagerLoadRelationships()
                    ->where('category_id', $category->id)
                    ->latest()
                    ->get()
            );

            return $this->success(
                config('general.messages.request.success'),
                $products
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
