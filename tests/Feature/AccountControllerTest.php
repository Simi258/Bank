<?php

namespace Tests\Feature;


use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Tests\TestCase;

class AccountControllerTest extends TestCase
{
    /** @test */
    public function can_it_show_the_correct_bank_balance(): void
    {
        // Create a user and login
        $user = User::factory()->create();
        $account = Account::factory()->create([
            'users_id' => $user->id
        ]);

        $response = $this->actingAs($user)->get('/accounts/' .$account->first());


        // See that the user is redirected to the dashboard
        $response = $this->get(route('dashboard', ['id'=>$account->account_id]));


        // See that the bank balance is correct
        $account = $user->accounts->first();
        $bankBalance = $account->bank_balance;
        $transactions = Transaction::where('users_id', $user->id)->get();
        foreach ($transactions as $transaction) {
            if ($transaction->account_id === $account->id) {
                $bankBalance -= $transaction->amount;
            }
        }

        $response->assertSee($bankBalance);

        // See that the transactions are displayed
        foreach ($transactions as $transaction) {
            $response->assertSee($transaction->amount);

        }

        $user->delete();
    }
}
