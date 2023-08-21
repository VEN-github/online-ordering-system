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
        $shippingPrice = new Money($this->shipping_price, new Currency(config('money.defaults.currency')));
        $price = new Money($this->total_price, new Currency(config('money.defaults.currency')));

        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'user' => UserResource::make($this->whenLoaded('user')),
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            // 'company' => $this->company,
            'address' => $this->address,
            // 'unit' => $this->unit,
            'city' => $this->city,
            'country' => $this->country,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'phone' => $this->phone,
            'payment_method' => $this->payment_method,
            'payment_status' => $this->payment_status,
            'status' => $this->status,
            'shipping_method' => $this->shipping_method,
            'shipping_price' => $shippingPrice->format(),
            'total_price' => $price->format(),
            'items' => ItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
