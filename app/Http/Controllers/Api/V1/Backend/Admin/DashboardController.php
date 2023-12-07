<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Api\Backend\DashboardProductResource;
use App\Models\Item\Item;
use App\Models\Order\Order;
use App\Models\Product\Product;
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
                    DB::raw('CAST(SUM(total_price / 100) AS SIGNED) as total_sales')
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
            $topSellingProducts = Item::query()
                ->with([
                    'order',
                    'product',
                ])
                ->whereHas('order', function ($query) {
                    $query->whereStatus(OrderStatus::COMPLETED);
                })
                ->get()
                ->map(fn (Item $item) => $item->product)
                ->groupBy('id')
                ->map(fn ($items) => $items->count())
                ->sortDesc()
                ->take(5)
                ->keys()
                ->toArray();

            $topSellingProducts = DashboardProductResource::collection(
                Product::query()
                    ->findMany($topSellingProducts) ?? []
            );

            $salesOverview = Order::query()
                ->whereStatus(OrderStatus::COMPLETED)
                ->select(
                    DB::raw('COALESCE(SUM(total_price / 100), 0) as total_sales'),
                    DB::raw('MONTH(created_at) as month')
                )
                ->whereYear('created_at', $year)
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->pluck('total_sales', 'month')
                ->toArray();

            $salesOverview = array_map(function ($month) use ($salesOverview) {
                return isset($salesOverview[$month]) ? (int) $salesOverview[$month] : 0;
            }, range(1, 12));

            return $this->success(
                config('general.messages.request.success'),
                collect([
                    'total_sales_per_month' => $numberOfTotalSalesPerMonth,
                    'total_income_current_month' => $numberOfTotalIncomeCurrentMonth,
                    'total_pending_orders' => $numberOfPendingOrders,
                    'total_registered_users' => $numberOfRegisteredUsers,
                    'sales_overview' => $salesOverview,
                    'top_selling_products' => $topSellingProducts,
                ])
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
