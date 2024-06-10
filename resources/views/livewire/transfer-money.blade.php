<x-slot name="header">
    <div class="flex flex-col lg:flex-row items-center lg:justify-between">
        <div class="flex items-center">
            <img src="{{ asset('storage/transfer-money.png') }}" alt="transaction" class="h-12 w-12 mr-4">
            <h1 class="text-xl font-bold">Transfer Money</h1>
        </div>
        <div class="flex mt-4 lg:mt-0">
            <a href="{{ route('dashboard', ['id' => $account->account_id]) }}" class="text-sm text-gray-600 underline">
                Go back
            </a>
        </div>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border border-indigo-400 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                @if(Session::has('success'))
                    <div class="alert alert-success text-green-700" x-data="{show: true}" x-init="setTimeout(() => show = false, 6000)" x-show="show">
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger text-red-700 " x-data="{show: true}" x-init="setTimeout(() => show = false, 6000)" x-show="show">
                        <ul>
                            <li>{{ session('error') }}</li>
                        </ul>
                    </div>
                @endif
                @if(Session::has('sent'))
                    <div class="alert text-yellow-500 alert-warning" x-data="{show:true}" x-init="setTimeout(() => show = false, 10000)" x-show="show">
                        <strong>{{ Session::get('sent') }}</strong>
                    </div>
                @endif
                    <form wire:submit.prevent="store"  class="w-full max-w-lg mx-auto mt-2">
                        <div class="grid grid-cols-2 gap-6">
                        <div class="col-span-1">
                            <x-input-label for="to_iban" :value="__('Receiver Iban')" />
                            <x-text-input id="to_iban" class="mt-1 block w-full py-2 px-3 border {{ $errors->has('to_iban')? 'border-red-500' : 'border-gray-300' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="to_iban" required wire:model="to_iban" />
                            <x-input-error :messages="$errors->get('to_iban')" class="mt-1" />
                        </div>

                        <div class="col-span-1">
                            <x-input-label for="from_iban" :value="__('Sender Iban')" />
                            <x-text-input id="from_iban" class="mt-1 block w-full py-2 px-3 text-gray-500 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="from_iban" value="{{ $account->iban }}" readonly />
                            <x-input-error :messages="$errors->get('from_iban')" class="mt-1" />
                        </div>

                        <div class="col-span-1">
                            <x-input-label for="amount" :value="__('Amount')" />
                            <div class="relative">
                                <x-text-input
                                    id="amount"
                                    class="mt-1 block w-full py-2 px-3 border {{ $errors->has('amount')? 'border-red-500' : 'border-gray-300' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    type="number"
                                    name="amount"
                                    required
                                    wire:model="amount"
                                /> {{--  --}}
                                <div class="absolute inset-y-0 right-8 pr-2 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm" aria-label="Euro symbol">€</span>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('amount')" class="mt-1" />
                        </div>

                        <div class="col-span-1">
                            <x-input-label for="transaction_title" :value="__('Transaction Title')" />
                            <input type="text" id="transaction_title" wire:model.live="transaction_title" class="mt-1 block w-full py-2 px-3 border{{ $errors->has('transaction_title') ? 'border-red-500' : 'border-gray-300' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <x-input-error :messages="$errors->get('transaction_title')" class="mt-1" />
                        </div>

                            <div class="col-span-1">
                                <x-input-label for="to_name" :value="__('Receiver Name')" />
                                <x-text-input id="to_name" class="mt-1 block w-full py-2 px-3 border {{ $errors->has('to_name')? 'border-red-500' : 'border-gray-300' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="to_name" required wire:model="to_name" />
                                <x-input-error :messages="$errors->get('to_name')" class="mt-1" />
                            </div>

                        <div class="col-span-1">
                            <x-input-label for="transaction_description" :value="__('Description')" />
                            <input type="text" id="transaction_description" wire:model.live="transaction_description" class="mt-1 block w-full py-2 px-3 border {{ $errors->has('transaction_description') ? 'border-red-500' : 'border-gray-300' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <x-input-error :messages="$errors->get('transaction_description')" class="mt-1" />
                        </div>
                    </div>

                        <button class="group relative w-full flex justify-center py-2 my-4 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500" type="submit" >
                            Submit
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>
