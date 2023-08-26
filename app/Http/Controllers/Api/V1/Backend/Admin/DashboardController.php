<?php

namespace App\Http\Controllers\Api\V1\Backend\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Order\Order;
use App\Models\User\User;
use Illuminate\Http\Request;

class DashboardController extends BaseController
{
    public function index()
    {
        try {
            $numberOfTotalSalesPerMonth = 0;
            $numberOfTotalIncomeCurrentMonth = 0;
            $numberOfPendingOrders = Order::whereStatus(OrderStatus::PENDING->value)->count();
            $numberOfRegisteredUsers = User::count();

            return $this->success(
                config('general.messages.request.success'),
                collect([
                    'total_sales_per_month' => $numberOfTotalSalesPerMonth,
                    'total_income_current_month' => $numberOfTotalIncomeCurrentMonth,
                    'total_pending_orders' => $numberOfPendingOrders,
                    'total_registered_users' => $numberOfRegisteredUsers
                ])
            );
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
