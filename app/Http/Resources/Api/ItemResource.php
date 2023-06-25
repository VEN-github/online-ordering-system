<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Backend\OrderResource;
use App\Http\Resources\Api\Backend\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'order' => OrderResource::make($this->whenLoaded('order')),
            'product' => ProductResource::make($this->whenLoaded('product')),
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
        ];
    }
}
