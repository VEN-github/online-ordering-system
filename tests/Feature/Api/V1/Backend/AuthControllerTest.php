<?php

use App\Models\Admin\Admin;
use App\Models\Image\Image;
use Database\Factories\AdminFactory;
use Illuminate\Http\JsonResponse;

$encryptionModes = [
    [true],
    [false],
];

it('logged_in_the_admin_encrypted', function (bool $enabled) {
    config(['ciphersweet.enabled' => $enabled]);

    $email = 'sample@sample.com';
    $admin = Admin::factory()
        ->state(fn () => ['email' => $email])
        ->has(Image::factory())
        ->create();

    expect(! is_null($admin))->toBeTrue();

    $response = $this->post(route('admin.login'), [
        'email' => $email,
        'password' => AdminFactory::PASSWORD
    ]);

    $response->assertStatus(JsonResponse::HTTP_OK);
})->with($encryptionModes);
