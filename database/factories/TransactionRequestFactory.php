<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TransactionRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users_id' => User::factory()->create(),
            'accounts_id' => Account::factory()->create(),
            'sender_name' => $this->faker->name(),
            'receiver_name'=> $this->faker->name(),
            'sender_iban' => $this->faker->iban(),
            'receiver_iban' =>$this->faker->iban(),
            'transaction_title'=> $this->faker->title(),
            'reason' => $this->faker->text(),
            'amount'=>$this->faker->biasedNumberBetween(),

        ];
    }
}
