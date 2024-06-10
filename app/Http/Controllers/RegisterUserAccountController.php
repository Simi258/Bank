<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterUserAccountController extends Controller
{
    public function create($id)
    {
        $user = User::all();
        $account = Account::all();
        $accounts = User::where('user_type', "customer")->findOrFail($id);
        return view('admin.user-register-account', compact('accounts'));
    }

    public function store(Request $request, $id)
    {
        $user = User::find($id);
        $accounts = Account::where('users_id', $user->id)->get();
        $attributes = $request->validate([
            'iban' => ['required', 'string', 'min:21', 'max:21', 'unique:accounts,iban,' . $user->id . ',users_id', 'regex:/^[a-zA-Z0-9]{21,21}$/'],
                     'bank_balance' => ['required', 'numeric', 'max:255'],
            'pin' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:4','min:4', 'unique:accounts,pin,' . $user->id . ',users_id']
        ]);

        $account = Account::create([
            'iban' => $attributes['iban'],
            'bank_balance' => $attributes['bank_balance'],
            'pin' => $attributes['pin'],
            'users_id' => $user->id,
        ]);

        event(new Registered($account));

        return redirect(route('admin.customer-info',[$user->id]))
            ->with('success', 'Account created successfully.');

    }
}
