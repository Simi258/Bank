<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


//currently not in use

/*class TransactionController extends Controller
{
    public function amount($id)
    {
        $user = Auth::user();
        $accounts = Account::where('users_id', $user->id)->find($id);
        $transactions = Transaction::where('accounts_id', $accounts->account_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('transaction.transaction', ['transactions' => $transactions], compact('accounts'));
    }*/


    //

   /* public function create($id)
    {
        $transfer = transaction::all();
        $user = Auth::user();
        $account = Account::where('users_id', $user->id)->find($id);

        return view('transaction.transfer-money', compact('transfer', 'account'));
    }*/

   /* public function store (Request $request, $id)
    {
        $user = Auth::user();
        $accounts = Account::where('users_id', $user->id)->find($id);
        $users = User::all();
        $request->validate([
            'to_iban' => ['required'],
            'from_iban' => 'required',
            'transaction_description' => 'required',
            'transaction_title' => 'required|max:10',
            'amount' => ['required', 'numeric'],
        ], [
            'to_iban' => 'Account number does not exist. please enter a valid account number'
        ]);
        //m
        $amount = $request->input("amount");
        $Receiver_iban = $request->input("to_iban");
        $user_account = Account::where("iban", $Receiver_iban)->first();
        $title = $request->input("transaction_title");


          if (!$user_account) {
            return redirect()->back()->withErrors([
                "error" => " Account number doesn't exist. Please enter a valid account number "
            ]);
        }

          //

        if ($Receiver_iban == $accounts) {
            return redirect()->back()->withErrors([
                "error" => "Cannot transfer to self. Transaction declined"
            ]);
        }


        DB::beginTransaction();
        try {
            $check_balance = Account::where("users_id", Auth::user()->id)
                ->where("bank_balance", ">=", $amount)->lockForUpdate()->find($id);

            if (!$check_balance) {
                return redirect()->back()->with([
                    "error" => "Insufficient Funds!, Transaction declined."
                ]);
            }

            // *
            // Debit from sender's account
            $check_balance->bank_balance = $check_balance->bank_balance - $amount;
            $check_balance->save();

            // Credit in receiver(user) account
            $user_account->bank_balance = $user_account->bank_balance + $amount;
            $user_account->save();

            // Add debit to transactions
            $transaction = new transaction();
            $transaction->to_iban = $request->input('to_iban');
            $transaction->from_iban = $accounts->iban;
            $transaction->transaction_type = $request->input('transaction_type', "debit");
            $transaction->transaction_description = $request->input('transaction_description');
            $transaction->transaction_title = $request->input('transaction_title');
            $transaction->amount = $request->input('amount');
            $transaction->users_id = $user->id;
            $transaction->accounts_id = $accounts->account_id;
            $transaction->save();
            Log::info($transaction);

            // Add credit to transactions
            $transaction = new transaction();
            $transaction->to_iban = $request->input('to_iban');
            $transaction->from_iban = $accounts->iban;
            $transaction->transaction_type = $request->input('transaction_type', "credit");
            $transaction->transaction_description = $request->input('transaction_description');
            $transaction->transaction_title = $request->input('transaction_title');
            $transaction->amount = $request->input('amount');
            $transaction->users_id = $user_account->users_id;
            $transaction->accounts_id = $user_account->account_id;
            $transaction->save();


            // Explicitly commit transaction
            DB::commit();
            return redirect()->back()->with([
                "success" => "Transaction Successful!."
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function show($id) {
        $user = Auth::user();
        $account = Account::where('users_id', $user->id)->find($id);
        $transaction = Transaction::findOrFail($id);

        return view('transaction.show-transaction', compact('transaction'));
    }

}*/







