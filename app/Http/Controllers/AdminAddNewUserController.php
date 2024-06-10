<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAddNewUserController extends Controller
{
        public function create()
        {
            return view('admin.register-new-user');
        }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'username' => ['required','string', 'unique:' .User::class],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'username' => $attributes['username'],
            'password' => Hash::make($attributes['password']),
        ]);

        event(new Registered($user));

        return redirect(route('admin.register-new-user'))
            ->with('status', 'New User created successfully!');
    }
}
