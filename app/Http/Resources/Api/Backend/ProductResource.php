<?php

namespace App\Http\Resources\Api\Backend;

use App\Collections\AttributeCollection;
use App\Collections\VariationCollection;
use App\Http\Resources\SupplierResource;
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
            'price' => $this->price,
            'discounted_price' => $this->discounted_price,
            'standard_shipping_price' => $this->standard_shipping_price,
            'express_shipping_price' => $this->express_shipping_price,
            'supplier' => SupplierResource::make($this->whenLoaded('supplier')),
            'attributes' => $this->whenLoaded('attributes')
                ? AttributeCollection::make(
                        AttributeResource::collection($this->whenLoaded('attributes'))
                    )
                : [],
            'variations' => $this->whenLoaded('variations')
                ? VariationCollection::make(
                        VariationResource::collection($this->whenLoaded('variations'))
                    )
                : [],
            'images' => $this->whenLoaded('images')->map(
                fn ($image) => $image->getUrl()
            ),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
