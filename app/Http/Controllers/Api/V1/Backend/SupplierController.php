<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier\Supplier;
use Exception;

class SupplierController extends BaseController
{
    public function index()
    {
        try {
            $suppliers = Supplier::query()
                ->latest()
                ->paginate($this->paginate);

            return $this->success(
                config('general.messages.request.success'),
                $suppliers
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function store(SupplierRequest $request)
    {
        try {
            $supplier = Supplier::create($request->validated());

            return $this->success(
                config('general.messages.model.created'),
                $supplier
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function show(string $id)
    {
        try {
            $supplier = Supplier::find($id);

            return $supplier
                ? new SupplierResource($supplier)
                : $this->error(config('general.messages.model.not_found'));
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function update(SupplierRequest $request, string $id)
    {
        try {
            $supplier = Supplier::find($id);

            if (is_null($supplier)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $supplier->update($request->validated());

            return $this->success(
                config('general.messages.model.updated'),
                $supplier
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function destroy(string $id)
    {
        try {
            $supplier = Supplier::find($id);

            if (is_null($supplier)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $supplier->delete();

            return $this->success(config('general.messages.model.deleted'));
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
