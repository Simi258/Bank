<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function Laravel\Prompts\password;

class PasswordConfirmationTest extends TestCase
{
    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/confirm-password');

        $response->assertStatus(200);
        $user->delete();

    }

    public function test_password_can_be_confirmed(): void
    {
        $user = User::factory()->create([
            'password' => 'password',
        ]);


        $response = $this->actingAs($user)
            ->post('/confirm-password', [
                'password' => 'password',
            ]);


        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
        $user->delete();

    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::factory()->create();


        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
        $user->delete();

    }
}
