<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Product;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Api\Backend\SupplierResource;
use App\Models\Supplier\Supplier;
use Exception;

class SupplierController extends BaseController
{
    public function index()
    {
        try {
            $suppliers = Supplier::query()
                ->latest()
                ->get();

            return $this->success(
                config('general.messages.request.success'),
                SupplierResource::collection($suppliers)
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
