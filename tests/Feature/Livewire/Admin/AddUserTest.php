<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\AddUser;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class AddUserTest extends TestCase
{
    /** @test */
    public function admin_can_create_a_user()
    {
        Livewire::test(AddUser::class)
            ->set('name','Sonal Kaur')
            ->set('username','Sonal')
            ->set('email', 'sonal@example.com')
            ->set('password','123456789')
            ->set('password_confirmation','123456789')
            ->call('create');

        $this->assertDatabaseHas('users', [
            'name' => 'Sonal Kaur',
            'email' => 'sonal@example.com',
            'username' => 'Sonal',
        ]);

        // Delete the user
        $user = User::where('name', 'Sonal Kaur')
            ->where('email', 'sonal@example.com')
            ->where('username', 'Sonal')
            ->first();

        $user->delete();

        $this->assertDatabaseMissing('users', [
            'name' => 'Sonal Kaur',
            'email' => 'sonal@example.com',
            'username' => 'Sonal',
        ]);
    }
}
