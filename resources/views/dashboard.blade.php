

@props(['accounts'])
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between px-4 py-2 ">
            <div class="flex flex-row items-center">
                <div class="text-2xl font-semibold text-gray-800">{{ Auth::user()->username }} </div>
            </div>
            <div class="flex flex-row items-center">
                <div class="text-gray-600"> Bank Balance: </div>
                <div class="text-xl font-bold text-gray-800 ml-4"> {{ $account->bank_balance."€" }} </div>
                <div class="ml-4">
                    <a href="{{ route('accounts') }}" class="text-sm text-gray-600 underline">
                        Go Back
                    </a>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white border rounded-lg  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex">
                <img src="{{ asset('storage/transaction.png') }}"  alt="transaction">
                    <a href="{{ route('transaction-show', ['id' => $account->account_id]) }}" class=" text-blue-600 text-lg hover:underline pl-4 pt-5">View Transactions</a>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden  border rounded-lg shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex">
                    <img src="{{ asset('storage/send(2).png') }}" alt="money" >
                    <a href="{{ route('transaction.transfer-money' , ['id'=>$account->account_id]) }}" class="text-blue-600 text-lg hover:underline list-disc pl-4 pt-5">Send Money</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


