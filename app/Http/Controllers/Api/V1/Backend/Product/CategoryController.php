<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Product;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Api\Backend\CategoryResource;
use App\Models\Category\Category;
use Exception;

class CategoryController extends BaseController
{
    public function index()
    {
        try {
            $categories = Category::query()
                ->with('image')
                ->latest()
                ->get();

            return $this->success(
                config('general.messages.request.success'),
                CategoryResource::collection($categories)
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
