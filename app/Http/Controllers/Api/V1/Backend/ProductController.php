<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Actions\StoreImages;
use App\Actions\Product\StoreVariations;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\ProductRequest;
use App\Http\Resources\Api\Backend\ProductResource;
use App\Models\Product\Product;

class ProductController extends BaseController
{
    public function index()
    {
        try {
            $products = Product::query()
                ->eagerLoadRelationships()
                ->latest()
                ->paginate($this->paginate);

            return $this->success(
                    config('general.messages.request.success'),
                    $products
                );
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->validated());
            $highlight = Product::getHighlightImageCollection();
            $collection = Product::getImageCollection();

            StoreImages::runIf(
                $request->hasFile($highlight),
                $product,
                $highlight
            );

            StoreImages::runIf(
                $request->hasFile($collection),
                $product,
                $collection
            );

            StoreVariations::runIf(
                $request->has('variations'),
                $product,
                $request->get('variations')
            );

            $product = $product->loadMissingRelationships();

            return $this->success(
                    config('general.messages.model.created'),
                    ProductResource::make($product)
                );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
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

    public function update(ProductRequest $request, string $slug)
    {
        try {
            $product = Product::query()
                ->eagerLoadRelationships()
                ->whereSlug($slug)
                ->first();
            $highlight = Product::getHighlightImageCollection();
            $collection = Product::getImageCollection();

            if (is_null($product)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $product->update($request->validated());

            StoreImages::runIf(
                $request->hasFile($highlight),
                $product,
                $highlight
            );

            StoreImages::runIf(
                $request->hasFile($collection),
                $product,
                $collection
            );

            StoreVariations::runIf(
                $request->has('variations'),
                $product,
                $request->get('variations')
            );

            $product = $product
                ->fresh()
                ->loadMissingRelationships();

            return $this->success(
                    config('general.messages.model.updated'),
                    ProductResource::make($product)
                );
        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    public function destroy(string $slug)
    {
        try {
            $product = Product::query()
                ->eagerLoadRelationships()
                ->whereSlug($slug)
                ->first();

            if (is_null($product)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            StoreImages::run(
                $product,
                Product::getImageCollection()
            );

            StoreImages::run(
                $product,
                Product::getHighlightImageCollection()
            );

            StoreVariations::run($product, []);

            $product->delete();

            return $this->success(config('general.messages.model.deleted'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
