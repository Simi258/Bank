<?php

namespace Tests\Feature\Livewire;

use App\Livewire\TransferMoney;
use App\Models\Account;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TransferMoneyTest extends TestCase
{
    protected  $user;
    protected $senderAccount;
    protected $receiverAccount;
    /** @test */
    public function test_store_method()
    {
        // Arrange
        $this->user = User::factory()->create();
        $this->senderAccount = Account::factory()->create([
            'users_id' => $this->user->id,
            'bank_balance' => 1000,
        ]);

        $this->receiverAccount = Account::factory()->create([
            'users_id' => $this->user->id,
            'bank_balance' => 500,
        ]);


        Livewire::actingAs($this->user)
            ->test(TransferMoney::class, ['id' => $this->senderAccount->account_id])
            ->set('to_iban', $this->receiverAccount->iban)
            ->set('from_iban', $this->senderAccount->iban)
            ->set('transaction_description', 'Test transaction')
            ->set('transaction_title', 'Test')
            ->set('amount', 200)
            ->call('store');

        // Assert

        $this->assertEquals(800, $this->senderAccount->fresh()->bank_balance);
        $this->assertEquals(700, $this->receiverAccount->fresh()->bank_balance);
    }
    protected function tearDown(): void
    {
        User::destroy($this->user->id);
        Account::destroy($this->senderAccount->account_id);
        Account::destroy($this->receiverAccount->account_id);
    }
}
