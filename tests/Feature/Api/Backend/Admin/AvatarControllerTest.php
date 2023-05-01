<?php

declare(strict_types=1);

use App\Models\Admin\Admin;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

beforeEach(function () {
    $this->token = $this->actingAsAdmin();
});

it('can_destroy_a_record', function () {
    $admin = Admin::factory()->create();

    $admin
        ->addMediaFromUrl(fake()->imageUrl())
        ->toMediaCollection(Admin::AVATAR_MEDIA_ATTRIBUTE);

    expect($admin->avatar)->toBeInstanceOf(Media::class);

    $response = $this->withHeaders($this->token)
        ->delete(route('admin.avatar.destroy', $admin->id));

    $response->assertOk();

    $admin = $admin->fresh();

    expect($admin->avatar)->toBe(null);
});
