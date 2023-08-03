<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Frontend\User\PasswordRequest;
use App\Models\User\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class PasswordController extends BaseController
{
    public function update(PasswordRequest $request, string $id)
    {
        try {
            $user = User::find($id);

            if (is_null($user)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $validated = $request->validated();

            $user->update([
                'password' => Hash::make($validated['password']),
            ]);

            return $this->success(config('general.messages.model.updated'));
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
