<?php

namespace App\Http\Controllers\Api;

use App\Helpers\HttpStatus;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    protected HttpStatus $httpStatus;
    protected bool $status = false;
    protected string $message = '';
    protected int $statusCode;

    public function __construct()
    {
        $this->httpStatus = new HttpStatus;
    }
}
