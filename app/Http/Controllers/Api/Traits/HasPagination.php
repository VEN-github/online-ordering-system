<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\Request;

trait HasPagination
{
    protected int $paginate;

    public function __construct(Request $request)
    {
        $paginationDefault = config('pagination.default');
        $paginationMaximum = config('pagination.maximum');

        $this->paginate = $request->paginate ?? $paginationDefault;
        $this->paginate = ($this->paginate > $paginationMaximum)
            ? $paginationMaximum
            : $this->paginate;
    }
}
