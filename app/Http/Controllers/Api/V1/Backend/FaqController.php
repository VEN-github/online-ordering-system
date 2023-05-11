<?php

namespace App\Http\Controllers\Api\V1\Backend;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\Backend\FaqRequest;
use App\Http\Resources\FaqResource;
use App\Models\Faq\Faq;

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
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function store(FaqRequest $request)
    {
        try {
            $faq = Faq::create($request->validated());

            return $this->success(
                config('general.messages.model.created'),
                FaqResource::make($faq)
            );
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function show(string $slug)
    {
        try {
            $faq = Faq::query()
                ->whereSlug($slug)
                ->first();

            return $faq
                ? FaqResource::make($faq)
                : $this->error(config('general.messages.model.not_found'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function update(FaqRequest $request, string $slug)
    {
        try {
            $faq = Faq::query()
                ->whereSlug($slug)
                ->first();

            if (is_null($faq)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $faq->update($request->validated());

            return $this->success(
                config('general.messages.model.updated'),
                FaqResource::make($faq)
            );
        } catch (\Exception $e) {
            return $this->error();
        }
    }

    public function destroy(string $slug)
    {
        try {
            $faq = Faq::query()
                ->whereSlug($slug)
                ->first();

            if (is_null($faq)) {
                return $this->error(config('general.messages.model.not_found'));
            }

            $faq->delete();

            return $this->success(config('general.messages.model.deleted'));
        } catch (\Exception $e) {
            return $this->error();
        }
    }
}
