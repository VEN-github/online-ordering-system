<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\SendsResponses;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use SendsResponses;
}
