<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Admin\Admin;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function actingAsAdmin(): array
    {
        $admin = Admin::factory()->create();
        $token = $admin->createToken(Admin::ACCESS_TOKEN)
            ->plainTextToken;

        return [
            'Authorization' => 'Bearer ' . $token,
        ];
    }
}
