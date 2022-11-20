<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register()
    {
        $response = $this->post('auth/register', [
            'first_name' => 'Test',
            'last_name' => 'User',
            'full_name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'receives_browser_notifications' => false,
            'receives_email_notifications' => false,
        ]);

        $this->assertAuthenticated();
        $response->assertNoContent();
    }
}
