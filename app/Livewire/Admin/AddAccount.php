<?php

namespace App\Livewire\Admin;

use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddAccount extends Component
{
    public $id;
    public $iban;
    public $pin;

    public function mount($id)
    {
        $this->id = $id;
    }

    public function render()
    {
        $this->user = User::findOrFail($this->id);
        $this->accounts = User::where('user_type', "customer")->findOrFail($this->id);

        return view('livewire.admin.add-account',['accounts' => $this->accounts]);
    }

    public function store($id)
    {
        $this->user = User::find($id);

        $attributes = $this->validate([
            'iban' => ['required', 'string', 'min:21', 'max:21', 'unique:accounts,iban,'. $this->user->id . ',users_id', 'regex:/^[a-zA-Z0-9]{21,21}$/'],
            'pin' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:4', 'min:4', 'unique:accounts,pin,' . $this->user->id . ',users_id']
        ]);

        $createAccount =  Account::create([
            'iban' => $attributes['iban'],
            'bank_balance' => 0,
            'pin' => $attributes['pin'],
            'users_id' => $this->user->id,
        ]);

        event(new Registered($createAccount));

        return redirect(route('admin.customer-info', $this->user->id))
            ->with('success', 'Account created successfully.');
    }
}
