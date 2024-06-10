<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class UserAccountsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            abort(404, 'Account not found.');
        }
        $accounts = $user->accounts;

        return view('accounts', compact('accounts', 'user'));
    }

}




