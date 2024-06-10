<?php

namespace App\Livewire;

use App\Models\Account;
use App\Models\transaction;
use App\Models\TransactionRequest;
use App\Models\User;

use Hamcrest\Core\DescribedAs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class TransferMoney extends Component
{
    public $to_iban;
    public $to_name;
    public $from_iban;
    public $transaction_description;
    public $transaction_title;
    public $amount;
    public $account_id;
    public $submitted = false;
    public function mount($id)
    {
        $this->account_id = $id;
        $this->from_iban = $id;
    }

    public function render()
    {
        $user = Auth::user();
        $account = Account::where('users_id', $user->id)->find($this->account_id);

        return view('livewire.transfer-money', compact('account') );
    }

    public function store()
    {
        $user = Auth::user();
        $account = Account::where('users_id', $user->id)->find($this->account_id);

        $validator = Validator::make($this->validateData(), [
            'to_iban' => 'required|exists:accounts,iban',
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                    if ($value <= 0) {
                        $fail('The '.$attribute.' must be a positive number.');
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = "The following errors occurred:\n\n";
            foreach ($errors as $error) {
                $errorMessage .= "- " . $error . "\n";
            }
            $this->errorResponse($errorMessage);
        }

        $validatedData = $this->validateData();
        $receiverAccount = $this->getReceiverAccount($validatedData['to_iban']);

        if (!$receiverAccount) {
            return $this->errorResponse("Account number doesn't exist. Please enter a valid account number.");
        }

        if ($receiverAccount->iban == $account->iban) {
            return $this->errorResponse("Cannot transfer to self. Transaction declined.");
        }

        if (!$this->checkBalance($account, $validatedData['amount'])) {
            return $this->errorResponse("Insufficient Funds!, Transaction declined.");
        }


        if($this->validateData()['amount'] > 5000)
        {
            // Send the request to TransactionRequest
            $validator->fails();
            transaction::create([
            'users_id' => $user->id,
            'accounts_id'=> $account->account_id,
            'from_name' => Auth::user()->name,
            'from_iban' => $account->iban,
            'to_name' => $this->validateData()['to_name'],
            'to_iban' => $this->validateData()['to_iban'],
            'transaction_title' =>$this->validateData()['transaction_title'],
            'transaction_description' => $this->validateData()['transaction_description'],
            'transaction_process' => 'pending',
            'amount' => $this->validateData()['amount'],
            ]);
            return redirect()->with('sent','The transaction has been forwarded to the employer for approval, as the amount is above 5000€');

        }




        $this->debitAccount($account, $validatedData['amount']);
        $this->creditAccount($receiverAccount, $validatedData['amount']);
        $debitTransaction = $this->debitTransaction($account, $validatedData, 'debit');
        $creditTransaction = $this->creditTransaction($receiverAccount, $account,$validatedData, 'credit');

        // dd($debitTransaction,$creditTransaction);
        return $this->successResponse("Transaction Successful!");
    }

    private function validateData()
    {
        return $this->validate([
            'to_iban' => 'required',
            'to_name' => 'required',
            'from_iban' => ['required', Rule::in([$this->from_iban])],
            'transaction_description' => ['required', 'min:20'],
            'transaction_title' => ['required', 'max:10'],
            'amount' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) {
                if ($value <= 0) {
                        $fail('The '.$attribute.' must be a positive number.');
                }
                },
            ],
        ],[
            'from_iban.required' => 'The Sender Iban is required',
            'to_iban.required' => 'The Receiver iban is required',
            'transaction_description.min' => 'The  description field must be at least 20 characters.'
        ]);
    }

    private function getReceiverAccount(string $iban): ?Account
    {
        return Account::where('iban', $iban)->first();
    }
    private function checkBalance($account, $amount)
    {
        return Account::where("users_id", $account->users_id)
            ->where("bank_balance", ">=", $amount)
            ->lockForUpdate()
            ->find($account->account_id);
    }

    private function debitAccount($account, $amount)
    {
        $account->bank_balance -= $amount;
        $account->save();
    }

    private function creditAccount($account, $amount)
    {
        $account->bank_balance += $amount;
        $account->save();
    }


    protected function debitTransaction($account, $validatedData, $type)
    {
        $transaction = new Transaction();
        $transaction->from_iban = $account->iban;
        $transaction->from_name = Auth::user()->name;
        $transaction->to_iban = $validatedData['to_iban'];
        $transaction->to_name = $validatedData['to_name'];
        $transaction->transaction_type = $type;
        $transaction->transaction_description = $validatedData['transaction_description'];
        $transaction->transaction_title = $validatedData['transaction_title'];
        $transaction->amount = $validatedData['amount'];
        $transaction->users_id = Auth::user()->id;
        $transaction->accounts_id = $account->account_id;
        $transaction->save();

        return $transaction;
    }

    protected function creditTransaction($receiverAccount, $senderAccount,$validatedData, $type)
    {
        $transaction = new Transaction();
        $transaction->from_iban = $senderAccount->iban;
        $transaction->from_name = Auth::user()->name;
        $transaction->to_iban = $receiverAccount->iban;
        $transaction->to_name = $validatedData['to_name'];
        $transaction->transaction_type = $type;
        $transaction->transaction_description = $validatedData['transaction_description'];
        $transaction->transaction_title = $validatedData['transaction_title'];
        $transaction->amount = $validatedData['amount'];
        $transaction->users_id = $receiverAccount->users_id;
        $transaction->accounts_id = $receiverAccount->account_id;
        $transaction->save();

        return $transaction;

    }

    private function errorResponse($message)
    {
        return redirect()->back()->with([
            "error" => $message
        ]);
    }

    private function successResponse($message)
    {
        return redirect()->back()->with([
            "success" => $message
        ]);
    }

}
