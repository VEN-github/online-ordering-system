<?php

declare(strict_types=1);

namespace App\Http\Resources\Api\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sku' => $this->sku,
            'slug' => $this->slug,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'description' => $this->description,
            'orig_price' => $this->orig_price,
            'discounted_price' => $this->discounted_price,
            'standard_shipping_price' => $this->standard_shipping_price,
            'express_shipping_price' => $this->express_shipping_price,
            'stocks' => $this->stocks,
            'supplier' => SupplierResource::make($this->whenLoaded('supplier')),
            'has_variations' => $this->relationLoaded('variations')
                ? $this->variations->count() > 0
                : 0,
            'variations' => VariationResource::collection($this->whenLoaded('variations')),
            'highlight_image' => $this->when(
                $this->relationLoaded('highlightImages'),
                function () {
                    return $this->highlightImages
                        ->map(fn ($image) => $image->getUrl())
                        ->first();
                }
            ),
            'images' => $this->when(
                $this->relationLoaded('images'),
                function () {
                    return $this->images->map(fn ($image) => $image->getUrl());
                }
            ),
            'stocks' => $this->stocks,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
