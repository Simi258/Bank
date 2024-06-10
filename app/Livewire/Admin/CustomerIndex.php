<?php

namespace App\Livewire\Admin;

use App\Models\Account;
use App\Models\User;
use Livewire\Component;

class CustomerIndex extends Component
{

    public $search = '';
    protected $queryString = ['search'];
    public function render()
    {
        $customers = User::where('user_type', "customer")
            ->when($this->search, function ($query, $search)
            {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(9)
            ->withQueryString();
        return view('livewire.Admin.customer-index',['customers'=>$customers]);
    }

    public function show($id)
    {
        $customers = User::where('user_type', "customer")->findOrFail($id);
        $customers->account = $customers->account ?: new Account();
        return view('livewire.Admin.customer-info',['customers'=>$customers]);


    }






}
