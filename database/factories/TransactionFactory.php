<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;
    /**
     * Define the model's default state.
     *
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $sender = User::factory()->create();
        $receiver = User::factory()->create();
        $fromAccount = Account::factory()->create([
            'users_id' => $sender->id,
        ]);

        $toAccount = Account::factory()->create([
            'users_id' => $receiver->id,
        ]);


        return [
            'transaction_description' => $this->faker->sentence(),
            'transaction_title' => $this->faker->title(),
            'amount' => $this->faker->biasedNumberBetween(),
            'users_id' => $sender->id,
            'from_name' => $sender->name,
            'to_name' => $receiver->name,
            'accounts_id' => $fromAccount->account_id,
            'from_iban' => $fromAccount->iban,
            'to_iban' => $toAccount->iban
        ];
    }
}
