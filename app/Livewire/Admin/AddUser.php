<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AddUser extends Component
{
    public $name;
    public $email;
    public $username;
    public $password;
    public $password_confirmation;

    public function render()
    {
        return view('livewire.admin.add-user');
    }

    public function create()
    {
        $attributes = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'username' => ['required', 'string', 'unique:' . User::class],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'username' => $attributes['username'],
            'password' => Hash::make($attributes['password']),
        ]);

        event(new Registered($user));

        $this->reset();

        session()->flash('status', 'New User created successfully!');
    }
}
