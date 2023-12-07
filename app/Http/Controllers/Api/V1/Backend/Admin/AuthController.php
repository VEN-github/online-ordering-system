<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Backend\Admin;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\Admin\AuthLoginRequest;
use App\Http\Resources\Api\Backend\AdminResource;
use App\Models\Admin\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends BaseController
{
    public function login(AuthLoginRequest $request)
    {
        try {
            $email = $request->email;
            $admin = Admin::with('avatar')
                ->filterByEmail($email)
                ->first();

            if ( ! Auth::guard('web_admins')->attempt([
                'email' => $admin?->email,
                'password' => $request->password,
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
                    'admin' => AdminResource::make($admin),
                    'token' => $admin
                        ->createToken(Admin::ACCESS_TOKEN)
                        ->plainTextToken,
                ]
            );
        } catch (Exception $e) {
            Log::error($e);

            return $this->error('Unable to login the user.');
        }
    }

    public function logout()
    {
        try {
            if(method_exists(auth()->user()->currentAccessToken(), 'delete')) {
                auth()->user()->currentAccessToken()->delete();
            }

            auth()->guard('web')->logout();

            return $this->success();
        } catch (Exception $e) {
            return $this->error('Unable to logout the user.');
        }
    }
}
