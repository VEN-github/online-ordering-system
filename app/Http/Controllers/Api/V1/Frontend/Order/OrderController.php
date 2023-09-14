<?php

namespace App\Http\Controllers\Api\V1\Frontend\Order;

use App\Actions\Order\StoreAddress;
use App\Actions\Product\GenerateRefId;
use App\Actions\Order\StoreItems;
use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Frontend\Order\OrderRequest;
use App\Http\Resources\Api\Backend\OrderResource;
use App\Models\Order\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends BaseController
{
    public function index()
    {
        try {
            $orders = Order::query()
                ->whereUserId(auth()->user()->id)
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

    public function store(OrderRequest $request)
    {
        DB::beginTransaction();

        try {
            if (! $request->has('items')
                || (is_array($request->items) && count($request->items) === 0)) {
                throw ValidationException::withMessages(['No items detected.']);
            }

            $data = $request->validated();
            $data['ref_id'] = GenerateRefId::run();
            $data['user_id'] = auth()->user()->id;

            $order = Order::create($data);

            StoreAddress::run(
                auth()->user(),
                $order
            );

            StoreItems::run(
                $order,
                $request->items
            );

            DB::commit();

            $order = $order->loadMissing('items');

            return $this->success(
                    config('general.messages.request.success'),
                    OrderResource::make($order)
                );
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage());
        }
    }
}
