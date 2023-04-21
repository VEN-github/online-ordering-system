<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Traits\HasPagination;
use App\Http\Requests\Api\Backend\SupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier\Supplier;

class SupplierController extends BaseController
{
    use HasPagination;

    public function index()
    {
        try {
            $suppliers = Supplier::paginate($this->paginate);
        } catch (\Exception $e) {
            return $this->error();
        }

        return SupplierResource::collection($suppliers);
    }

    public function store(SupplierRequest $request)
    {
        try {
            $supplier = Supplier::create($request->validated());
        } catch (\Exception $e) {
            return $this->error();
        }

        return $this->success(
            config('general.messages.model.created'),
            $supplier
        );
    }

    public function show(string $id)
    {
        try {
            $supplier = Supplier::find($id);
        } catch (\Exception $e) {
            return $this->error();
        }

        return $supplier
            ? new SupplierResource($supplier)
            : $this->error(config('general.messages.model.not_found'));
    }

    public function update(SupplierRequest $request, string $id)
    {
        try {
            $supplier = Supplier::find($id);

            if (is_null($supplier)) return $this->error(config('general.messages.model.not_found'));

            $supplier->update($request->validated());
        } catch (\Exception $e) {
            return $this->error();
        }

        return $this->success(
            config('general.messages.model.updated'),
            $supplier
        );
    }

    public function destroy(string $id)
    {
        try {
            $supplier = Supplier::find($id);

            if (is_null($supplier)) return $this->error(config('general.messages.model.not_found'));

            $supplier->delete();
        } catch (\Exception $e) {
            return $this->error();
        }

        return $this->success(config('general.messages.model.deleted'));
    }
}
