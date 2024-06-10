<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class ShowAccount extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $user = $this->user;
        $accounts = $user->accounts;
        return view('livewire.admin.show-account',compact('accounts','user'));
    }
}
