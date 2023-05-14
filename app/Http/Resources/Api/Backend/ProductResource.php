<?php

namespace App\Http\Resources\Api\Backend;

use App\Collections\AttributeCollection;
use App\Collections\VariationCollection;
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
            'name' => $this->name,
            'slug'=> $this->slug,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'description' => $this->description,
            'orig_price' => $this->orig_price,
            'discounted_price' => $this->discounted_price,
            'standard_shipping_price' => $this->standard_shipping_price,
            'express_shipping_price' => $this->express_shipping_price,
            'supplier' => SupplierResource::make($this->whenLoaded('supplier')),
            'variations' => $this->whenLoaded('variations')
                ? VariationCollection::make(
                        VariationResource::collection($this->whenLoaded('variations'))
                    )
                : [],
            'highlight_image' => $this->whenLoaded('highlightImages')
                ->map(
                    fn ($image) => $image->getUrl()
                )
                ->first() ?? null,
            'images' => $this->whenLoaded('images')->map(
                    fn ($image) => $image->getUrl()
                ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
