<?php

namespace Tests\Feature\Auth;

use App\Models\Account;
use App\Models\User;
use Tests\TestCase;

class RegisteredAccountControllerTest extends TestCase
{
    public function test_account_registration_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('auth.register-account');
        $response->assertStatus(200);
        $user->delete();

    }

    public function test_new_users_account_can_register(): void
    {
        $user = User::factory()->create();

        $account = Account::factory()->create();
        $iban = $account->iban . uniqid();
        $pin = $account->pin . uniqid();

        $response = $this->post('auth.register-account', [
            'bank_balance'=>$account->bank_balance,
            'iban' => $iban,
            'pin'=>$pin,

        ]);


        // Log in the user
        $this->actingAs($user);
        $this->assertAuthenticated();
        $response->assertRedirect('login');
        $user->delete();

    }
}
