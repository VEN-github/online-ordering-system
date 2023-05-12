<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\HasPagination;
use App\Http\Controllers\Api\Traits\SendsResponses;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BaseController extends Controller
{
    use HasPagination;
    use SendsResponses;

    public function __construct(Request $request)
    {
        $this->bootHasPaginate(
            (int) $request->input(
                'paginate',
                config('pagination.default')
            )
        );
    }
}
