<?php

use App\Models\Admin\Admin;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

it('works', function () {
    $password = 'admin';

    $admin =  Admin::create([
        'first_name' => 'Admin',
        'last_name' => 'Test',
        'email' => 'admin@admin.com',
        'password' => Hash::make($password)
    ]);

    expect(! is_null($admin))->toBeTrue();

    $response = $this->post('/api/admin/login', [
        'email' => $admin->email,
        'password' => $password,
    ]);

    $response->assertStatus(JsonResponse::HTTP_OK);
});