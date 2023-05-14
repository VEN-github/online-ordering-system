<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreImages
{
    use AsAction;

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle (Model $model, string $collection): void
    {
        $registeredMediaCollections = $model->getRegisteredMediaCollections();

        if (count($registeredMediaCollections) === 0) {
            return;
        } else {
            $mediaCollections = $registeredMediaCollections->map(function ($mediaCollection) {
                return $mediaCollection->name;
            });

            if ( ! in_array($collection, $mediaCollections->toArray())) {
                return;
            }
        }

        $model->clearMediaCollection($collection);

        if ($this->request->hasFile($collection)) {
            if (is_array($this->request->file($collection))) {
                $model
                    ->addMultipleMediaFromRequest([$collection])
                    ->each(function ($fileAdder) use ($collection) {
                        $fileAdder->toMediaCollection($collection);
                    });
            } else {
                $model
                    ->addMediaFromRequest($collection)
                    ->toMediaCollection($collection);
            }
        }
    }
}
