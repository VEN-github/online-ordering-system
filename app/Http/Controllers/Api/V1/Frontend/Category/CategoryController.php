<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\Category;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CategoryResource;
use App\Models\Category\Category;
use Exception;

class CategoryController extends BaseController
{
    public function index()
    {
        try {
            $categories = CategoryResource::collection(
                Category::query()
                    ->with('image')
                    ->get()
            );

            return $this->success(
                config('general.messages.request.success'),
                $categories
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function getFeatured()
    {
        try {
            $categories = CategoryResource::collection(
                Category::query()
                    ->with('image')
                    ->inRandomOrder()
                    ->limit(2)
                    ->get()
            );

            return $this->success(
                config('general.messages.request.success'),
                $categories
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
