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
}
