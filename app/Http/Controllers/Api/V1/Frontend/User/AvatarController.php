<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Frontend\User\AvatarRequest;
use App\Http\Resources\Api\Frontend\UserResource;
use App\Models\User\User;
use Exception;

class AvatarController extends BaseController
{
    public function store(AvatarRequest $request, string $id)
    {
        try {
            $user = User::find($id);

            if (is_null($user)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $user
                ->addMediaFromRequest('avatar')
                ->toMediaCollection(User::AVATAR_MEDIA_ATTRIBUTE);

            return $this->success(
                config('general.messages.request.success'),
                UserResource::make($user)
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }

    public function destroy(string $id)
    {
        try {
            $user = User::find($id);

            if (is_null($user)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $user->avatar()->delete();

            return $this->success();
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
