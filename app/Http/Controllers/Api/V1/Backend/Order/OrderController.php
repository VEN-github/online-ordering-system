<?php

namespace App\Http\Controllers\Api\V1\Backend\Order;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Api\Backend\OrderResource;
use App\Models\Order\Order;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function index()
    {
        try {
            $orders = Order::query()
                ->eagerLoadRelationships()
                ->latest()
                ->get();

            return $this->success(
                    config('general.messages.request.success'),
                    OrderResource::collection($orders)
                );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
