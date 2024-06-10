<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminAccountController extends Controller
{
    public function show(User $user)
    {
        $accounts = $user->accounts;
        return view('admin.customer-account-show', compact('user','accounts'));
    }

    public function edit(User $user, $id)
    {
        $accounts = Account::where('users_id', $user->id)->find($id);
        return view('admin.customer-account-edit', compact('accounts', 'user'));
    }

    public function update(Account $account)
    {
        $attributes = $this->validateAccount($account);

        $account->update($attributes);

        if($attributes === 'unique')
        {
            return back()->with('error','{{$attributes. is unique}}' );
        }

        return back()->with('success', 'Account Updated!');
    }

    protected function validateAccount(?Account $account = null): array
    {
        $account ??= new Account();
        $rules = [
            'iban'=>['required', 'unique:accounts,iban,'. $account->account_id . ',account_id','min:21', 'max:21', 'regex:/^[a-zA-Z0-9]{21,21}$/'],
            'pin'=>['required', 'unique:accounts,pin,'. $account->account_id . ',account_id', 'min:4'],
            'bank_balance'=>['required'],
        ];
        return request()->validate($rules);
    }


    public function delete(int $id)
    {
        $account = Account::find($id);

        if (!$account) {
            return redirect()->back()->withErrors(['message' => 'Account not found']);
        }

        $account->delete();

        session(['delete_account' => $account]);

        return redirect()->route('admin.customer-account-show', ['user' => $account->users_id])->with('deleted', 'Account deleted successfully.');
    }
}
