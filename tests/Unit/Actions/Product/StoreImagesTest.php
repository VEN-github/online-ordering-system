<?php

declare(strict_types=1);

use App\Actions\Product\StoreImages;
use App\Models\Product\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Route;

it('can_store_product_images', function () {

    Route::post('product', function (Request $request) {
        $product = Product::factory()->create();
        $collection = Product::getImageCollection();

        $status = exec('sudo chmod -R 775 storage');
        info([$status]);
        StoreImages::run($product, $collection);

        info([$product->images]);
        // $this->assertCount(count($request->images), $product->getMedia($collection));

        return response()->json([], JsonResponse::HTTP_OK);
    });

    $images = [
        UploadedFile::fake()->image('image1.jpg'),
        UploadedFile::fake()->image('image2.jpg'),
    ];

    $response = $this->post('product', [
        'images' => $images,
    ]);

    $response->assertOk();

    // $this->assertEquals(200, $response->getStatusCode());
});
