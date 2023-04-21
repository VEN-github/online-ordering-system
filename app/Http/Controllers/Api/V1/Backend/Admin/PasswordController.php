<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\Admin\PasswordRequest;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Hash;

class PasswordController extends BaseController
{
    public function patch(PasswordRequest $request, string $id)
    {
        $admin = Admin::find($id);

        if (is_null($admin)) {
            return $this->error(config('general.messages.model.not_found'));
        }

        $validated = $request->validated();

        $admin->update([
            'password' => Hash::make($validated['password']),
        ]);

        return $this->success();
    }
}
