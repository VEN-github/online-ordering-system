<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category\Category;

class CategoryController extends BaseController
{
    public function index()
    {
        try {
            $categories = Category::query()
                ->latest()
                ->paginate($this->paginate);

            return $this->success(
                config('general.messages.request.success'),
                $categories
            );
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create($request->validated());

            return $this->success(
                config('general.messages.model.created'),
                CategoryResource::make($category)
            );
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function show(string $slug)
    {
        try {
            $category = Category::query()
                ->whereSlug($slug)
                ->first();

            return $category
                ? CategoryResource::make($category)
                : $this->error(config('general.messages.model.not_found'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function update(CategoryRequest $request, string $slug)
    {
        try {
            $category = Category::query()
                ->whereSlug($slug)
                ->first();

            if (is_null($category)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $category->update($request->validated());

            return $this->success(
                config('general.messages.model.updated'),
                CategoryResource::make($category)
            );
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function destroy(string $slug)
    {
        try {
            $category = Category::query()
                ->whereSlug($slug)
                ->first();

            if (is_null($category)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $category->delete();

            return $this->success(config('general.messages.model.deleted'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
