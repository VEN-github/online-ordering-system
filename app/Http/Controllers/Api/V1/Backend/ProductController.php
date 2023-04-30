<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Actions\Product\StoreAttributes;
use App\Actions\Product\StoreImages;
use App\Actions\Product\StoreVariations;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\ProductRequest;
use App\Http\Resources\Api\Backend\ProductResource;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    public function index()
    {
        try {
            $products = Product::query()
                ->eagerLoadRelationships()
                ->latest()
                ->get();

            return $this->success(
                    config('general.messages.request.success'),
                    ProductResource::collection($products)
                );
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function store(ProductRequest $request)
    {
        try {
            $product = Product::create($request->validated());
            $collection = Product::getImageCollection();

            StoreImages::runIf(
                $request->hasFile($collection),
                $product,
                $collection
            );

            StoreAttributes::runIf(
                $request->has('attributes'),
                $product,
                $request->get('attributes')
            );

            StoreVariations::runIf(
                $request->has('variations'),
                $product,
                $request->get('variations')
            );

            return $this->success(
                    config('general.messages.model.created'),
                    ProductResource::make($product)
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

    public function update(ProductRequest $request, string $slug)
    {
        try {
            $product = Product::query()
                ->eagerLoadRelationships()
                ->whereSlug($slug)
                ->first();

            if (is_null($product)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $product->update($request->validated());

            $collection = Product::getImageCollection();

            StoreImages::runIf(
                $request->hasFile($collection),
                $product,
                $collection
            );

            StoreAttributes::runIf(
                $request->has('attributes'),
                $product,
                $request->get('attributes')
            );

            StoreVariations::runIf(
                $request->has('variations'),
                $product,
                $request->get('variations')
            );

            return $this->success(
                    config('general.messages.model.updated'),
                    ProductResource::make($product)
                );
        } catch (\Exception $e) {
            return $this->error();
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

            StoreAttributes::run($product, []);

            StoreVariations::run($product, []);

            $product->delete();

            return $this->success(config('general.messages.model.deleted'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
