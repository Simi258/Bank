<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\Livewire;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class CustomerEdit extends Component
{
    use WithPagination, WithFileUploads;

    public $user;
    public $name;
    public $username;
    public $email;
    public $user_type;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->user_type = $user->user_type;
    }

    public function update()
    {
        $validatedData = $this->validate();

        $this->user->update($validatedData);

        $this->resetForm();
        return redirect()->with('success','Customer updated successfully');

    }

    public function delete()
    {
        $this->user->delete();
        return redirect()->with('deleted','User was deleted successfully')
            ->route('admin.customer');
    }

    public function resetForm()
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->username = $this->user->username;
        $this->user_type = $this->user->user_type;
    }

    public function render()
    {
        return view('livewire.Admin.customer-edit');
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user->id,
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $this->user->id,],
            'user_type' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'The username has already been taken.',
            'email.unique'=>'the email has already been taken',
        ];
    }
}
