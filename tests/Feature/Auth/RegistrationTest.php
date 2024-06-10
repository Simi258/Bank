<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $user = User::factory()->create();
        $username = $user->username . uniqid();
        $email = $user->email . uniqid() ;
        $response = $this->post('/register', [

            'name' => $user->name,
            'username' => $username,
            'email' => $email,
            'password' => $user->password,
            'password_confirmation' => $user->password,

        ]);


        $this->assertAuthenticated();
        $response->assertRedirect('auth.register-account');
        $user->delete();

    }
}
