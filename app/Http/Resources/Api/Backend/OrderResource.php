<?php

namespace App\Http\Resources\Api\Backend;

use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Http\Resources\Api\ItemResource;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'user' => UserResource::make($this->whenLoaded('user')),
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'status' => $this->status,
            'shipping_method' => $this->shipping_method,
            'total_price' => $price->format(),
            'items' => ItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
