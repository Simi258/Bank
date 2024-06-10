<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AccountController extends Controller
{
    public function index($id)
    {
        $user = Auth::user();
        $account = Account::where('users_id', $user->id)->find($id);

        if (!$account) {
            abort(404, 'Account not found.');
        }

        $transactions = Transaction::where('accounts_id', $account->account_id)->get();

        $bankBalance = $account->bank_balance;
        foreach ($transactions as $transaction) {
            if ($transaction->account_id === $account->id) {
                if ($transaction->type === 'debit') {
                    $bankBalance -= $transaction->amount;
                } elseif ($transaction->type === 'credit') {
                    $bankBalance += $transaction->amount;
                }
            }
        }

        return view('dashboard', [
            'bankBalance' => $bankBalance,
            'transactions' => $transactions,
            'account' => $account,
        ]);
    }
    //

    public function show()
    {
        $user = Auth:: user();
        $account = Account::where('users_id', $user->id)->get();
        return view('account.info-account',['user' => $user, 'account' => $account]);
    }

}


