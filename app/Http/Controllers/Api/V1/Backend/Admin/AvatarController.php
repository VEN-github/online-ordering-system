<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\Admin\AvatarRequest;
use App\Models\Admin\Admin;
use Exception;

class AvatarController extends BaseController
{
    public function store(AvatarRequest $request, string $id)
    {
        try {
            $admin = Admin::find($id);

            if (is_null($admin)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $admin
                ->addMediaFromRequest('avatar')
                ->toMediaCollection(Admin::AVATAR_MEDIA_ATTRIBUTE);

            return $this->success(config('general.messages.model.updated'));
        } catch (Exception $e) {
            return $this->error($e);
        }
    }

    public function destroy(string $id)
    {
        try {
            $admin = Admin::find($id);

            if (is_null($admin)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $admin->avatar()->delete();

            return $this->success();
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
