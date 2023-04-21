<?php

declare(strict_types=1);

use App\Models\Admin\Admin;

beforeEach(function () {
    $this->token = $this->actingAsAdmin();
});

it('can_show_a_record', function () {
    $admin = Admin::get()->first();

    $response = $this->withHeaders($this->token)
        ->get(route('admin.profile.show', $admin->id));

    $response->assertOk();
});

it('can_update_a_record', function () {
    $admin = Admin::factory()->create();
    $newFirstName = fake()->firstName();
    $newLastName = fake()->lastName();

    $response = $this->withHeaders($this->token)
        ->patch(route('admin.profile.patch', $admin->id), [
            'first_name' => $newFirstName,
            'last_name' => $newLastName,
        ]);

    $response->assertOk();

    $admin = Admin::find($admin->id);

    expect($admin->first_name)->toBe($newFirstName);
    expect($admin->last_name)->toBe($newLastName);
});