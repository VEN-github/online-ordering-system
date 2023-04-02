<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\V1\Backend\AuthLoginRequest;
use App\Models\Admin\Admin;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends BaseController
{
    public function login(AuthLoginRequest $request)
    {
        try {
            if(! Auth::guard('web_admins')->attempt($request->only(['email', 'password']))) {
                $this->message = 'Email & Password does not match with our record.';
                $this->statusCode = $this->httpStatus::NOT_FOUND;

                throw new Exception($this->message);
            }

            $admin = Admin::where('email', $request->email)->first();

            $this->status = true;
            $this->message = 'Successfully Logged In';
            $this->statusCode = $this->httpStatus::OK;

            Log::info([
                'message' => $this->message,
                'admin' => $admin->email
            ]);
        } catch (\Exception $e) {
            Log::error($e);

            $this->status = false;
            $this->message = 'Unable to login the user.';
            $this->statusCode = $this->httpStatus::INTERNAL_SERVER_ERROR;
        }

        return response()->json([
            'status' => $this->status,
            'message' => $this->message
        ], $this->statusCode);
    }
}