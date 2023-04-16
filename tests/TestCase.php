<?php

namespace Tests;

use App\Models\Admin\Admin;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;
use Tests\CreatesApplication;

class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function actingAsAdmin(): void
    {
        Sanctum::actingAs(
            Admin::factory()->create(),
            ['*']
        );
    }
}
