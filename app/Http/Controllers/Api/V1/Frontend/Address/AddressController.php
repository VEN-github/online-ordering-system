<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\Address;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Frontend\Address\AddressRequest;
use App\Http\Resources\Api\Frontend\AddressResource;
use App\Models\Address\Address;
use Exception;

class AddressController extends BaseController
{
    public function index()
    {
        try {
            $addresses = AddressResource::collection(
                Address::query()
                    ->with('user')
                    ->get()
            );

            return $this->success(
                config('general.messages.request.success'),
                $addresses
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function store(AddressRequest $request)
    {
        try {
            $data = $request->validated();
            $data['user_id'] = auth()->user()->id;

            $address = Address::create($data);

            return $this->success(
                    config('general.messages.request.success'),
                    AddressResource::make($address)
                );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(AddressRequest $request, string $id)
    {
        try {
            $data = $request->validated();

            $address = Address::find($id);
            $address->update($data);

            return $this->success(
                    config('general.messages.model.updated'),
                    AddressResource::make($address)
                );
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function destroy(string $id)
    {
        try {
            $address = Address::find($id);

            if ($address) {
                $address->delete();
            }

            return $this->success(config('general.messages.model.deleted'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
