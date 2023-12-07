<?php

namespace App\Http\Resources\Api\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardProductResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'price' => money($this->selling_price, 'PHP')->format(),
        ];
    }
}
