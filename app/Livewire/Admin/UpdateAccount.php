<?php

namespace App\Livewire\Admin;

use App\Models\Account;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UpdateAccount extends Component
{
    use WithPagination, WithFileUploads;

    public $user;
    public  $accounts;
    public $iban;
    public $pin;
    public $bank_balance;

    public function mount(User $user, Account $id)
    {
        $this->user = $user;
        $this->accounts= $id;
        $this->iban = $id->iban;
        $this->pin = $id->pin;
        $this->bank_balance = $id->bank_balance;
    }

    public function update()
    {
        $validateData = $this->validate();

        $this->accounts->update($validateData);

          $this->resetForm();

        return redirect()->with('success','Account updated successfully');
    }

    public function delete()
    {
        $this->accounts->delete();
        return redirect()->with('deleted','Account was deleted successfully')
            ->route('admin/show-account', $this->user);
    }
    public function resetForm()
    {
        $this->iban = $this->accounts->iban;
        $this->pin = $this->accounts->pin;
        $this->bank_balance = $this->accounts->bank_balance;
    }
    public function render()
    {
        return view('livewire.admin.update-account');
    }
    protected function rules()
    {
        return [
            'iban'=>['required', 'unique:accounts,iban,'. $this->accounts->account_id . ',account_id','min:21', 'max:21', 'regex:/^[a-zA-Z0-9]{21,21}$/'],
            'pin'=>['required', 'unique:accounts,pin,'. $this->accounts->account_id . ',account_id', 'min:4'],
            'bank_balance'=>['required'],
        ];
    }

    public function messages()
    {
        return [
            'iban.unique' => 'The iban has already been taken.',
            'pin.unique'=>'the pin has already been taken',
        ];
    }


}
