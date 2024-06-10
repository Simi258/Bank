<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TransactionShow;
use App\Models\Account;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TransactionShowTest extends TestCase
{
    protected $user;
    protected $account;
    protected $transaction;

    /** @test */
    public function renders_successfully()
    {
        //

        $this->user = User::factory()->create();
        $this->account = Account::factory()->create([
            'users_id' => $this->user->id,
        ]);
       $this->transaction =  Transaction::factory()->count(5)->create([
            'accounts_id' => $this->account->account_id,
            'users_id' => $this->user->id
        ]);

        $this->actingAs($this->user);

        $component = Livewire::test(TransactionShow::class, ['id' => $this->account->account_id]);

        $component->assertViewIs('livewire.transaction-show');
        $component->assertViewHas('transactions');
        $component->assertViewHas('accounts');

        $transactions = $component->viewData('transactions');
        $this->assertCount(5, $transactions);
        $this->assertEquals($this->account->account_id, $transactions->first()->accounts_id);

    }
    protected function tearDown(): void
    {
        User::destroy($this->user->id);
        Account::destroy($this->account->account_id);
    }
}
