<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Traits;

trait HasPagination
{
    protected int $paginate = 0;

    protected function bootHasPaginate(int $paginate): void
    {
        $paginationDefault = config('pagination.default');
        $paginationMaximum = config('pagination.maximum');

        $paginate ??= $paginationDefault;

        $this->paginate = $paginate > $paginationMaximum
            ? $paginationMaximum
            : $paginate;
    }
}
