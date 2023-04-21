<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\Admin\ProfileRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;

class ProfileController extends BaseController
{
    public function show(string $id)
    {
        $admin = Admin::find($id);

        return $admin
            ? new AdminResource($admin)
            : $this->error(config('general.messages.model.not_found'));
    }

    public function patch(ProfileRequest $request, string $id)
    {
        $admin = Admin::find($id);

        if (is_null($admin)) {
            return $this->error(config('general.messages.model.not_found'));
        }

        $admin->update($request->validated());

        return $this->success();
    }
}
