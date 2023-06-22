<?php

declare(strict_types=1);

use App\Models\Category\Category;
use App\Models\Product\Product;
use App\Models\Supplier\Supplier;
use App\Models\Variation\Variation;
use Illuminate\Http\UploadedFile;

beforeEach(function () {
    $this->token = $this->actingAsAdmin();
});

it('can_get_the_records', function () {
    Product::factory()->count(rand(1, 100))->create();

    $response = $this->withHeaders($this->token)
        ->get(route('admin.product.index'));

    $response->assertOk();
});

it('can_create_a_record', function () {
    $category = Category::factory()->create();
    $supplier = Supplier::factory()->create();
    $product = Product::factory()
        ->state([
            'category_id' => $category->id,
            'supplier_id' => $supplier->id,
        ])
        ->make()
        ->toArray();
    $highlight = Product::getHighlightImageCollection();
    $highlightImage = UploadedFile::fake()->image('test.jpg');
    $collection = Product::getImageCollection();
    $images = [
        UploadedFile::fake()->image('test_1.jpg'),
        UploadedFile::fake()->image('test_2.jpg'),
    ];
    $variations = Variation::factory()
        ->count(3)
        ->make()
        ->toArray();

    $response = $this->withHeaders($this->token)
        ->post(
            route('admin.product.store'),
            array_merge(
                $product,
                [
                    $highlight => $highlightImage,
                    $collection => $images,
                    'variations' => $variations
                ]
            )
        );

    // $product = Product::first();

    // expect($product->name)->toBe($product['name']);

    // expect($product->highlightImages()->first())
    //     ->not()
    //     ->toBeNull();

    // $this->assertCount(
    //     sizeof($variations),
    //     $product->variations
    // );

    info([$response->getContent()]);

    $response->assertOk();
});
