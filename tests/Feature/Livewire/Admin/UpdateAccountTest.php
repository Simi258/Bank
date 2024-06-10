<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\UpdateAccount;
use App\Models\Account;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateAccountTest extends TestCase
{
    public $user;
    public $employer;
    public $account;
    /** @test */

     /**@test*/
    public function renders_successfully()
    {

        $this->employer = User::factory()->create([
            'user_type' => 'employer'
        ]);

        $this->user = User::factory()->has(Account::factory()->count(1))->create();
        $this->account = $this->user->accounts->first();

        Livewire::test(UpdateAccount::class, ['user' => $this->user, 'id' => $this->account])
        ->assertStatus(200);
    }

    /** @test */
    public function test_employer_can_update_users_account()
    {
        $this->employer = User::factory()->create([
            'user_type' => 'employer'
        ]);

        $this->user = User::factory()->has(Account::factory()->count(1))->create();
        $this->account = $this->user->accounts->first();

        Livewire::test(UpdateAccount::class,['user' => $this->user,'id'=>$this->account])
                ->set('iban', 'DE7374394892742027492')
                ->set('pin', '4584')
                ->set('bank_balance', '00')
                ->call('update');


        $this->assertDatabaseHas('accounts', [
            'iban' => 'DE7374394892742027492',
            'pin' => '4584',
            'bank_balance' => '00',
            'account_id' => $this->account->account_id,
            'users_id' => $this->user->id,
        ]);

    }


    /**@test*/
    public function test_employer_can_delete_users_account()
    {
        $this->user = User::factory()->has(Account::factory()->count(1))->create();
        $this->account = $this->user->accounts->first();
        $this->employer = User::factory()->create([
            'user_type' => 'employer'
        ]);

        Livewire::test(UpdateAccount::class,['user' => $this->user,'id' => $this->account->account_id])
            ->call('delete');

        $this->assertDatabaseMissing('accounts',[
            'account_id' => $this->account->account_id
        ]);

    }

        protected function tearDown() :void
        {
            User::destroy($this->employer->id);
            User::destroy($this->user->id);
            Account::destroy($this->account->account_id);
        }
}
