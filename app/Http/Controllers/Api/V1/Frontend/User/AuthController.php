<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Auth\AuthLoginRequest;
use App\Http\Resources\Api\Frontend\UserResource;
use App\Models\User\User;
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
            $user = User::with('avatar')
                ->filterByEmail($email)
                ->first();

            if ( ! Auth::guard('users')->attempt([
                'email' => $user?->email,
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
                'user' => $user->email,
            ]);

            return $this->success(
                $message,
                [
                    'user' => UserResource::make($user),
                    'token' => $user
                        ->createToken(User::ACCESS_TOKEN)
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
            auth()->user()->currentAccessToken()->delete();

            return $this->success();
        } catch (Exception $e) {
            return $this->error('Unable to logout the user.');
        }
    }
}
