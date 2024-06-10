<?php

namespace Database\Factories;

use App\Models\ContactUs;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ContactUsFactory extends Factory
{

    protected $model = ContactUs::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'message'=> $this->faker->paragraph,
            'name'=>$this->faker->name,
            'email'=>$this->faker->email,
            'users_id' => User::factory()->create(),
            'created_at'=>$this->faker->time
        ];
    }
};
