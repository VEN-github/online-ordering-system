<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\Admin\ProfileRequest;
use App\Http\Resources\Api\Backend\AdminResource;
use App\Models\Admin\Admin;

class ProfileController extends BaseController
{
    public function show(string $id)
    {
        try {
            $admin = Admin::find($id);

            return $admin
            ? AdminResource::make($admin)
            : $this->error(config('general.messages.model.not_found'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function update(ProfileRequest $request, string $id)
    {
        try {
            $admin = Admin::find($id);

            if (is_null($admin)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $admin->update($request->validated());

            return $this->success(config('general.messages.model.updated'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
