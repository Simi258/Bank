<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionInfo extends Component
{
    public $account_id;
    public function mount($id)
    {
        $this->account_id = $id;
    }

    public function render()
    {
        $user = Auth::user();
        $account = Account::where('users_id', $user->id)->find($this->account_id);
        $transaction = Transaction::findOrFail($this->account_id);
        return view('livewire.transaction-info', compact('transaction','account'));
    }
}
