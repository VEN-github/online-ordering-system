<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Api\BaseController;
use App\Models\Order\Order;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Exception;

class DashboardController extends BaseController
{
    public function index()
    {
        $month = now()->month;
        $year = now()->year;

        try {
            $numberOfTotalSalesPerMonth = Order::query()
                ->select(
                    DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                    DB::raw('CAST(SUM(total_price) AS SIGNED) as total_sales')
                )
                ->whereStatus(OrderStatus::COMPLETED)
                ->whereYear('created_at', $year)
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'))
                ->get()
                ->toArray();
            $numberOfTotalIncomeCurrentMonth = Order::query()
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereStatus(OrderStatus::COMPLETED)
                ->with('items')
                ->get()
                ->flatMap(function ($order) {
                    return $order->items->map(function ($item) {
                        $origPrice = $item->orig_price;
                        $sellingPrice = $item->selling_price;
                        $discountedPrice = $item->discounted_price;

                        if ( ! is_null($discountedPrice)) {
                            $totalPrice = $origPrice - $discountedPrice;
                        } else {
                            $totalPrice = $origPrice - $sellingPrice;
                        }

                        return abs($totalPrice);
                    });
                })
                ->sum();
            $numberOfPendingOrders = Order::whereStatus(OrderStatus::PENDING)->count();
            $numberOfRegisteredUsers = User::count();

            return $this->success(
                config('general.messages.request.success'),
                collect([
                    'total_sales_per_month' => $numberOfTotalSalesPerMonth,
                    'total_income_current_month' => $numberOfTotalIncomeCurrentMonth,
                    'total_pending_orders' => $numberOfPendingOrders,
                    'total_registered_users' => $numberOfRegisteredUsers,
                ])
            );
        } catch (Exception $e) {
            return $this->error($e);
        }
    }
}
