<?php

declare(strict_types=1);

use App\Models\Admin\Admin;
use Database\Factories\AdminFactory;

beforeEach(function () {
    $this->token = $this->actingAsAdmin();
});

it('can_patch_a_record', function () {
    $admin = Admin::factory()->create();
    $newPassword = fake()->password();

    $response = $this->withHeaders($this->token)
        ->patch(route('admin.password.patch', $admin->id), [
            'current_password' => AdminFactory::PASSWORD,
            'password' => $newPassword,
            'password_confirmation' => $newPassword,
        ]);

    $response->assertOk();

    $response = $this->post(route('admin.login'), [
        'email' => $admin->email,
        'password' => $newPassword,
    ]);

    $response->assertOk();
});
