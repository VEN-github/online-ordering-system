<?php

declare(strict_types=1);

namespace App\Http\Resources\Api;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
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
        $price = new Money($this->total_price, new Currency(config('money.defaults.currency')));

        return [
            'id' => $this->id,
            'order' => OrderResource::make($this->whenLoaded('order')),
            'product' => ProductResource::make($this->whenLoaded('product')),
            'quantity' => $this->quantity,
            'total_price' => $price->format(),
        ];
    }
}
