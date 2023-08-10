<?php

namespace App\Http\Controllers\Api\V1\Frontend\Order;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Frontend\Order\OrderRequest;
use App\Http\Resources\Api\Backend\OrderResource;
use App\Models\Order\Order;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function store(OrderRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;

            $order = Order::create($data);

            return $this->success(
                    config('general.messages.request.success'),
                    OrderResource::make($order)
                );
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
