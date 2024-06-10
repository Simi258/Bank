<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Component;

class TransactionShow extends Component
{

    public $account_id;
    public $status;


    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function mount($id)
    {
        $this->account_id = $id;
        $this->now = now();
        $this->status = 'accepted';


    }

    public function render()
    {

        $user = Auth::user();
        $accounts = Account::where('users_id',$user->id)->find($this->account_id);
        $transactions = Transaction::where('accounts_id', $accounts->account_id)
            ->where('transaction_process', $this->status)
            ->orderBy('created_at', 'desc')
            ->get();
        $now = Carbon::now();
        return view('livewire.transaction-show', ['transactions' => $transactions, 'now' => $now], compact('accounts'));
    }


}
