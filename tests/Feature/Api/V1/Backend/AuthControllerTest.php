<?php

use App\Models\Admin\Admin;
use App\Models\Image\Image;
use Database\Factories\AdminFactory;
use Illuminate\Http\JsonResponse;

it('works', function () {
    $admin = Admin::factory()
        ->has(Image::factory())
        ->create();

    expect(! is_null($admin))->toBeTrue();

    $response = $this->post('/api/admin/login', [
        'email' => $admin->email,
        'password' => AdminFactory::PASSWORD
    ]);

    $response->assertStatus(JsonResponse::HTTP_OK);
});
