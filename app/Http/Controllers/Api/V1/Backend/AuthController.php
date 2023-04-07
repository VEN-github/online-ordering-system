<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\Backend\AuthLoginRequest;
use App\Models\Admin\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
    public function login(AuthLoginRequest $request)
    {
        try {
            if(! Auth::guard('web_admins')->attempt($request->only(['email', 'password']))) {
                $message = 'Email & Password does not match with our record.';

                return $this->error($message, JsonResponse::HTTP_NOT_FOUND);
            }

            $admin = Admin::where('email', $request->email)->first();
            $message = 'Successfully Logged In';

            Log::info([
                'message' => $message,
                'admin' => $admin->email
            ]);

            return $this->success($message);
        } catch (\Exception $e) {
            Log::error($e);

            return $this->error('Unable to login the user.');
        }
    }
}
