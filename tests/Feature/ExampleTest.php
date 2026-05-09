<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_dashboard_is_accessible_without_login(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_profile_requires_login(): void
    {
        $response = $this->get('/profile');

        $response->assertRedirect('/login');
    }

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
