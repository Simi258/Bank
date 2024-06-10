<?php

namespace Tests\Feature\Livewire\Admin;

use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class CustomerEditTest extends TestCase
{
    public $customer;
    public $employer;

    public function test_can_update_user()
    {
        // Create a customer
        $this->customer = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'username' => 'johndoe',
            'user_type' => 'customer',
        ]);

        $this->employer = User::factory()->create([
                'user_type' => 'employer'
        ]);


        // Visit the customer edit page
        $this->actingAs($this->employer)
            ->get(route('customers.edit', $this->customer->id))
            ->assertStatus(200);
        /*   */
        // Update the customer
        Livewire::test('admin.customer-edit', ['user' => $this->customer])
            ->set('name', 'Jane Doe')
            ->set('email', 'jane@example.com')
            ->set('username', 'janedoe')
            ->set('user_type', 'customer')
            ->call('update');

        // Check if the user was updated
        $this->assertDatabaseHas('users', [
            'id' => $this->customer->id,
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'username' => 'janedoe',
            'user_type' => 'customer',
        ]);

    }

    public function test_can_delete_user()
    {
        // Create a user
        $this->customer = User::factory()->create([
            'user_type' => 'customer',
        ]);
        $this->employer = User::factory()->create([
           'user_type' => 'employer'
        ]);


        // Visit the customer edit page
        $this->actingAs($this->employer)
            ->get(route('customers.edit', $this->customer->id))
            ->assertStatus(200);


        // Delete the user
        Livewire::test('admin.customer-edit', ['user' => $this->customer])
            ->call('delete');


        // Check if the user was deleted
        $this->assertDatabaseMissing('users', [
            'id' => $this->customer->id,

        ]);
    }

    public function tearDown(): void
    {
        User::destroy($this->customer->id);
        User::destroy($this->employer->id);
    }
}
