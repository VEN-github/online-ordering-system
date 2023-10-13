<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Frontend\User\ProfileRequest;
use App\Http\Resources\Api\Frontend\UserResource;
use App\Models\User\User;
use Exception;

class ProfileController extends BaseController
{
    public function show(string $id)
    {
        try {
            $user = User::find($id);

            return $user
                ? UserResource::make($user)
                : $this->error(config('general.messages.model.not_found'));
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function update(ProfileRequest $request, string $id)
    {
        try {
            $user = User::find($id);

            if (is_null($user)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $user->update($request->validated());

            return $this->success(
                config('general.messages.request.success'),
                UserResource::make($user)
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
