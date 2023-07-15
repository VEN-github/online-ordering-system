<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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

        if (! $this->request->has($collection)) {
            return;
        }

        $model->clearMediaCollection($collection);

        if ($this->request->hasFile($collection)) {
            if (is_array($this->request->file($collection))) {
                foreach ($this->request->file($collection) as $file) {
                    $path = $file->storeAs('public/images', uniqid() . '.jpg', 'local');

                    $model
                        ->addMedia($path)
                        ->toMediaCollection($collection);

                    // Storage::disk('local')->delete($path);
                }
            } else {
                $file = $this->request->file($collection);
                $path = $file->storeAs('public/images', uniqid() . '.jpg', 'local');

                $model
                    ->addMediaFromRequest($collection)
                    ->toMediaCollection($collection);

                // Storage::disk('local')->delete($path);
            }
        }
    }
}
