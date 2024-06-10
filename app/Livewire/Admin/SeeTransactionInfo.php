<?php

namespace App\Livewire\Admin;

use App\Models\Account;
use App\Models\transaction;
use App\Models\TransactionRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SeeTransactionInfo extends Component
{
    public $account_id;
    public $transactionProcess;

    public $from_iban;


    public function mount($id)
    {
        $this->account_id = $id;

        $this->transactionProcess = Transaction::findOrFail($id);

        $this->from_iban = $this->transactionProcess->from_iban;

    }
    public function render()
    {
        $request = transaction::findorfail($this->account_id);
        return view('livewire.admin.see-transaction-info', compact('request'));
    }

    public function accept()
    {
        if ($this->transactionProcess->transaction_process !== 'pending') {
            session()->flash('error', 'This transaction request has already been processed.');
            return;
        }

        // Debit the amount from the from_iban account
        $fromAccount = Account::where('iban', $this->transactionProcess->from_iban)->first();
        $fromAccount->bank_balance -= $this->transactionProcess->amount;
        $fromAccount->save();

        $toAccount = Account::where('iban', $this->transactionProcess->to_iban)->first();
        $toAccount->bank_balance += $this->transactionProcess->amount;
        $toAccount->save();


        // Create a credit transaction
        $creditTransaction = new Transaction();
        $creditTransaction->accounts_id = $toAccount->account_id;
        $creditTransaction->users_id = $toAccount->users_id;
        $creditTransaction->from_iban= $fromAccount->iban;
        $creditTransaction->from_name= $this->transactionProcess['from_name'];
        $creditTransaction->to_name = $this->transactionProcess['to_name'];
        $creditTransaction->transaction_description= $this->transactionProcess['transaction_description'];
        $creditTransaction->transaction_title =$this->transactionProcess['transaction_title'];
        $creditTransaction->to_iban = $toAccount->iban;
        $creditTransaction->amount = $this->transactionProcess->amount;
        $creditTransaction->transaction_type = 'credit';
        $creditTransaction->save();

        // Update the transaction process status
        $this->transactionProcess->update(['transaction_process' => 'accepted']);

        session()->flash('success', 'Transaction request has been accepted.');
    }


    public function decline()
    {
        if ($this->transactionProcess->transaction_process !== 'pending') {
            session()->flash('error', 'This transaction request has already been processed.');
            return;
        }

        $this->transactionProcess->update(['transaction_process' => 'declined']);
        session()->flash('success', 'Transaction request has been declined.');
    }

    public function putOnHold()
    {
        if ($this->transactionProcess->transaction_process !== 'pending') {
            $this->transactionProcess->update(['transaction_process' => 'pending']);
        } else {
            session()->flash('error', 'This transaction request is already on hold.');
        }
    }
}
