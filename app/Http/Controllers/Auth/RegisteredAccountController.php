<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegisteredAccountController extends Controller
{
    public function create()
    {
        $account = Account::all();
        return view('auth.register-account');
    }
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'iban' => ['required', 'string', 'min:21','max:21', 'regex:/^[A-Z0-9]{21}$/' ,'unique:accounts,iban,' . Auth::user()->id . ',users_id'],
            'bank_balance' => ['required', 'numeric', 'max:255'],
            'pin' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:4','min:4', 'unique:accounts,pin,' . Auth::user()->id . ',users_id']
        ],
        [
            'iban.regex' => 'The iban can only contain numbers[0-9] and letters[A-Z].',
            'pin.regex' => 'Pin can only contain numbers[0-9]'
        ]);

        $account = Account::create([
            'iban' => $attributes['iban'],
            'bank_balance' => $attributes['bank_balance'],
            'pin' => $attributes['pin'],
            'users_id' => Auth::user()->id,
        ]);


        event(new Registered($account));

        return redirect(route('accounts'))
            ->with('status', 'Account has been created successfully.');

    }
}
