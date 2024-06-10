<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\AddAccount;
use App\Models\Account;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class AddAccountTest extends TestCase
{
    protected $user;
    protected $employer;

    /** @test */
    public function show_add_account_form()
    {
        $this->user = User::factory()->create();
        $this->employer = User::factory([
            'user_type' => 'employer'
        ])->create();

        Livewire::actingAs($this->employer)
            ->test(AddAccount::class, ['id' => $this->user->id])
            ->assertStatus(200);
    }
    /** @test */
    public function show_add_account_form_with_invalid_data()
    {
        $this->user = User::factory()->create();
        $this->employer = User::factory([
            'user_type' => 'employer'
        ])->create();

        Livewire::actingAs($this->employer)
            ->test(AddAccount::class, ['id' => $this->user->id])
            ->set('iban','DE8549568494')
            ->set('pin','574')
            ->call('store', $this->user->id) // pass the $id parameter to the store method
            ->assertHasErrors(['iban' => 'min', 'pin' => 'min']);
    }

    protected function tearDown() :void
    {
        User::destroy($this->user->id);
        User::destroy($this->employer->id);
    }
}
