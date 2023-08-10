<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend;

use App\Actions\StoreImages;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\CategoryRequest;
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
                ->latest()
                ->get()
            );

            return $this->success(
                config('general.messages.request.success'),
                $categories->paginate($this->paginate)
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function store(CategoryRequest $request)
    {
        try {
            $category = Category::create($request->validated());
            $image = Category::getImageCollection();

            StoreImages::runIf(
                $request->hasFile($image),
                $category,
                $image
            );

            $category = $category->loadMissingRelationships();

            return $this->success(
                config('general.messages.model.created'),
                CategoryResource::make($category)
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function show(string $slug)
    {
        try {
            $category = Category::query()
                ->with('image')
                ->whereSlug($slug)
                ->first();

            return $category
                ? $this->success(
                    config('general.messages.request.success'),
                    CategoryResource::make($category)
                )
                : $this->error(config('general.messages.model.not_found'));
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function update(CategoryRequest $request, string $slug)
    {
        try {
            $category = Category::query()
                ->with('image')
                ->whereSlug($slug)
                ->first();

            if (is_null($category)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $category->update($request->validated());

            $image = Category::getImageCollection();

            StoreImages::run(
                $category,
                $image
            );

            $category = $category->loadMissingRelationships();

            return $this->success(
                config('general.messages.model.updated'),
                CategoryResource::make($category)
            );
        } catch (Exception $e) {
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
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
