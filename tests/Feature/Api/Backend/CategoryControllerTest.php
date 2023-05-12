<?php

declare(strict_types=1);

use App\Models\Category\Category;

beforeEach(function () {
    $this->token = $this->actingAsAdmin();
});

it('can_get_the_records', function () {
    Category::factory()->count(rand(1, 100))->create();

    $response = $this->withHeaders($this->token)
        ->get(route('admin.category.index'));

    $response->assertOk();
});

it('can_create_a_record', function () {
    $category = Category::factory()->make();

    $response = $this->withHeaders($this->token)
        ->post(route('admin.category.index'), [
            'name' => $category->name,
            'slug' => $category->slug,
        ]);

    $response->assertOk();
});

it('can_show_a_record', function () {
    $category = Category::factory()->create();

    $response = $this->withHeaders($this->token)
        ->get(route('admin.category.show', $category->slug));

    $response->assertOk();
});

it('can_update_a_record', function () {
    $category = Category::factory()->create();
    $newName = 'test';

    $response = $this->withHeaders($this->token)
        ->patch(route('admin.category.update', $category->slug), [
            'name' => $newName,
            'slug' => $category->slug,
        ]);

    $response->assertOk();

    $category = Category::find($category->id);

    expect($category->name)->toBe($newName);
});

it('can_delete_a_record', function () {
    $category = Category::factory()->create();

    $response = $this->withHeaders($this->token)
        ->delete(route('admin.category.destroy', $category->slug));

    $response->assertOk();

    $category = Category::find($category->id);

    expect($category)->toBeNull();
});
