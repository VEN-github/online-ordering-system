<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\Country;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\Api\Frontend\CountryResource;
use App\Models\Country\Country;
use Exception;

class CountryController extends BaseController
{
    public function index()
    {
        try {
            $countries = CountryResource::collection(
                Country::query()->get()
            );

            return $this->success(
                config('general.messages.request.success'),
                $countries
            );
        } catch (Exception $e) {
            return $this->error();
        }
    }
}
