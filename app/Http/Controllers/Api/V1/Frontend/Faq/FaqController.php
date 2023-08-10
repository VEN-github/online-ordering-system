<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Frontend\Faq;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\FaqResource;
use App\Models\Faq\Faq;
use Exception;

class FaqController extends BaseController
{
    public function index()
    {
        try {
            $faqs = Faq::query()
                ->latest()
                ->paginate($this->paginate);

            return $this->success(
                config('general.messages.request.success'),
                $faqs
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getFeatured()
    {
        try {
            $faqs = FaqResource::collection(
                Faq::query()
                    ->inRandomOrder()
                    ->limit(6)
                    ->whereActive(true)
                    ->get()
            );

            return $this->success(
                config('general.messages.request.success'),
                $faqs
            );
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
