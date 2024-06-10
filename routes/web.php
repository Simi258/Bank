<?php

use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\AdminAddNewUserController;
use App\Http\Controllers\Auth\RegisteredAccountController;
use App\Http\Controllers\ContactEmployerController;
use App\Http\Controllers\RegisterUserAccountController;
use App\Http\Controllers\UserAccountsController;
use App\Http\Controllers\UserController;
use App\Livewire\Admin\AcceptTransfer;
use App\Livewire\Admin\AddAccount;
use App\Livewire\Admin\AddUser;
use App\Livewire\Admin\CustomerEdit;
use App\Livewire\Admin\CustomerIndex;
use App\Livewire\Admin\MessageShow;
use App\Livewire\Admin\MessagesList;
use App\Livewire\Admin\SeeTransactionInfo;
use App\Livewire\Admin\ShowAccount;
use App\Livewire\Admin\UpdateAccount;
use App\Livewire\TransactionInfo;
use App\Livewire\TransactionShow;
use App\Livewire\TransferMoney;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Livewire\EmployerIndex;
use App\Http\Controllers\AdminSectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'destroy'])->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserController::class, 'destroy'])->name('profile.destroy');
    Route::get('/register',[RegisteredUserController::class, 'store'])->name('auth.register');
    Route::get('auth.register-account', [RegisteredAccountController::class, 'create'])->name('auth.register-account');
    Route::post('auth.register-account', [RegisteredAccountController::class, 'store'])->name('login');

    //Accounts
    Route::get('/accounts', [UserAccountsController::class, 'index'])->name('accounts');

    //Employer List
    Route::get('/employers', EmployerIndex::class)->name('employers');
    //individual Employer Info
    Route::get('employ/info-employer/{id}', [EmployerIndex::class,'show'])->name('employ.info-employer');

    //Dashboard
    Route::get('/dashboard/{id}', [AccountController::class, 'index'])->name('dashboard');

    //Personal Account Information
    Route::get('account/info-account', [AccountController::class, 'show'])->name('account.info-account');

    //Transaction List
    Route::get('transaction-show/{id}',TransactionShow::class)->name('transaction-show');

    // Individual Transaction Info
    Route::get('transaction-info/{id}',TransactionInfo::class)->name('transaction-info');


    //Transfer Money
    Route::get('transaction/transfer-money/{id}', TransferMoney::class)->name('transaction.transfer-money');

    //Contact Page
    Route::get('/contact', [ContactEmployerController::class,'create'])->name('contact');

    // Route to middleware Employer (Only Employer can access these Routes)
    Route::middleware('employer')->group(function () {

        //Admin Page
        Route::get('admin', [AdminSectionController::class, 'index'])->name('admin');

        //Admin Page Customers View
        Route::get('admin/customer',CustomerIndex::class)->name('admin.customer');

        //Admin Page Single Customer Info
        Route::get('admin/customer/info-{id}',[CustomerIndex::class, 'show'])->name('admin.customer-info');

        //Update/Delete Single Customer(User)
        Route::get('admin.customer-edit/{customer}', function (User $customer) {return view('admin.customer-edit', ['user' => $customer]);
        })->name('customers.edit');

        //See Users Accounts
        Route::get('admin/show-account/{user}',ShowAccount::class)->name('admin/show-account');

        //Update/Delete Single User Accounts
        Route::get('admin/update-account/{user}/{id}', UpdateAccount::class)->name('admin/update-account');

        //Admin can Register new Accounts For Separate Users
        Route::get('admin/add-account/{id}',AddAccount::class)->name('admin/add-account');

        //Admin can Register new User
        Route::get('admin/add/user', AddUser::class)->name('admin/add/user');

        //Admin can she all the messages
       Route::get('admin/messages/list',MessagesList::class)->name('admin/messages/list');

       //Admin can read and delete the messages
       Route::get('admin/message-show/{id}', MessageShow::class)->name('admin/message/show');

       Route::get('admin/accept-transfer', AcceptTransfer::class)->name('admin/accept-transfer');

       Route::get('admin/see-request/{id}/transaction',SeeTransactionInfo::class)->name('admin/see-request/transaction');

    });
});require __DIR__.'/auth.php';

