<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Order;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Frontend\Order\UpdateOrderStatusRequest;
use App\Http\Resources\Api\Backend\OrderResource;
use App\Models\Order\Order;
use Exception;

class OrderController extends BaseController
{
    public function index()
    {
        try {
            $orders = OrderResource::collection(
                Order::query()
                    ->eagerLoadRelationships()
                    ->latest()
                    ->get()
            );

            return $this->success(
                config('general.messages.request.success'),
                $orders->paginate($this->paginate)
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(UpdateOrderStatusRequest $request, string $refId)
    {
        try {
            $order = Order::query()
                ->eagerLoadRelationships()
                ->whereRefId($refId)
                ->first();

            if (is_null($order)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $order->update(['status' => $request->status]);

            return $this->success(
                config('general.messages.model.updated'),
                OrderResource::make($order)
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
