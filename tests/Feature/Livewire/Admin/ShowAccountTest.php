<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\ShowAccount;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ShowAccountTest extends TestCase
{
    public $employer;
    public $user;

    /** @test */
    public function admin_can_view_user_accounts()
    {
        $this->employer = User::factory()->create([
            'user_type' => 'employer'
        ]);
        $this->user = User::factory()->has(Account::factory()->count(3))->create();

        $this->actingAs($this->employer)
          ->get(route('admin/show-account', $this->user->id))
          ->assertStatus(200);

        Livewire::test(ShowAccount::class, ['user' => $this->user->id])
            ->assertSeeTextInOrder(
                $this->user->accounts->map(fn ($account) => $account->iban)
                    ->toArray()
            );
    }

    protected function tearDown(): void
    {
        User::destroy($this->employer->id);
        User::destroy($this->user->id)
;    }
}
