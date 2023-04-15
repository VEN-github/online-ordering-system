<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\Backend\AuthLoginRequest;
use App\Http\Resources\AdminResource;
use App\Models\Admin\Admin;
use App\Models\Image\Image;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
    public function login(AuthLoginRequest $request)
    {
        try {
            $email = $request->email;
            $admin = Admin::findByEmail($email);

            if (! Auth::guard('web_admins')->attempt([
                    'email' => $admin?->email,
                    'password' => $request->password
                ])) {

                $message = 'Email & Password does not match with our record.';

                return $this->error(
                    $message,
                    JsonResponse::HTTP_NOT_FOUND
                );
            }

            $message = 'Successfully Logged In';

            Log::info([
                'message' => $message,
                'admin' => $admin->email,
            ]);

            return $this->success(
                $message,
                [
                    'admin' => new AdminResource($admin),
                    'token' => $admin
                        ->createToken(Admin::ACCESS_TOKEN)
                        ->plainTextToken
                ]
            );
        } catch (\Exception $e) {
            Log::error($e);

            return $this->error('Unable to login the user.');
        }
    }

    public function logout(Request $request)
    {
        try {
            auth('sanctum')->user()->currentAccessToken()->delete();

            return $this->success();
        } catch (\Exception $e) {
            return $this->error('Unable to logout the user.');
        }
    }
}
