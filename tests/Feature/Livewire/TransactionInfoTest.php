<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TransactionInfo;
use App\Models\Account;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TransactionInfoTest extends TestCase
{
    public $user;
    public $account;
    public $transaction;
    /** @test */
    public function can_show_Transaction_info()
    {
        $this->user = User::factory()->create();
        $this->account = Account::factory()->create([
            'users_id' => $this->user->id,
            'pin' => '3776'
        ]);

        $this->transaction = Transaction::factory()->create([
            'users_id' => $this->user->id,
            'accounts_id' => $this->account->account_id
        ]);

        Livewire::actingAs($this->user)
            ->test(TransactionInfo::class, ['id' => $this->transaction->id])
            ->assertSee($this->transaction->description)
            ->assertSee($this->transaction->from_iban)
            ->assertSee($this->transaction->to_iban);


    }

    protected function tearDown(): void
    {
        User::destroy($this->user->id);
        Account::destroy($this->account->account_id);
        Transaction::destroy($this->transaction->id);
    }
}
