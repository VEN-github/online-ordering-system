<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Api\Traits\HasPagination;
use App\Http\Requests\Api\Backend\Supplier\SupplierStoreRequest;
use App\Http\Requests\Api\Backend\Supplier\SupplierUpdateRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier\Supplier;

class SupplierController extends BaseController
{
    use HasPagination;

    public function index()
    {
        $suppliers = Supplier::paginate($this->paginate);

        return SupplierResource::collection($suppliers);
    }

    public function store(SupplierStoreRequest $request)
    {
        Supplier::create($request->validated());

        return $this->success();
    }

    public function show(string $id)
    {
        $supplier = Supplier::find($id);

        return $supplier
            ? new SupplierResource($supplier)
            : $this->error(config('general.messages.model.not_found'));
    }

    public function update(SupplierUpdateRequest $request, string $id)
    {
        $supplier = Supplier::find($id);

        if (is_null($supplier)) {
            return $this->error(config('general.messages.model.not_found'));
        }

        $supplier->update($request->validated());

        return $this->success();
    }

    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);

        if (is_null($supplier)) {
            return $this->error(config('general.messages.model.not_found'));
        }

        $supplier->delete();

        return $this->success();
    }
}
