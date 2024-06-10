<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <div class="rounded-full p-1">
                        <img src="https://eu.ui-avatars.com/api/?name={{ $user->name }}&background=dec0f1" class=" rounded-full h-12 w-12 mr-2">
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 ">
                        <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                    </h2>
                </div>
            </div>
            <div class="flex mt-4 lg:mt-0">
                <div class="flex items-center">
                    <a href="{{ route('admin/show-account',[ 'user'=> $accounts->users_id]) }}" class="text-sm text-gray-600 underline">
                        Go Back
                    </a>
                </div>
                <div class="flex items-center ml-4">
                    <form method="post" action="{{ route('account.delete', ['id'=> $accounts->account_id]) }}">
                        @method('delete')
                        @csrf
                        <button class="text-sm bg-red-500 text-white py-1 px-3 rounded-lg">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                @if(Session::has('success'))
                    <div class="text-green-700 px-4 py-3 rounded relative mb-2" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ Session::get('success') }}</span>
                    </div>
                @endif
                <div class="flex items-center mb-6 mt-4">
                    <img src="https://eu.ui-avatars.com/api/?name={{ $user->name }}&background=b3dee2" class="h-12 rounded-full mr-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->username }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.customer-account-update', ['account' => $accounts->account_id ,'id' => $accounts->account_id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <x-input-label for="iban" :value="__('IBAN')" />
                            <x-text-input  id="iban" class="block mt-1 w-full  {{ $errors->has('iban') ? 'border-red-500' : 'border-gray-300' }}" type="text" name="iban" value="{{ old('iban', $accounts->iban) }}" required />
                            @if ($errors->has('iban'))
                                <p class="text-red-500 mt-2 text-xs ">{{ $errors->first('iban') }}</p>
                            @endif
                        </div>
                        <div>
                            <x-input-label for="pin" :value="__('PIN')" />
                            <x-text-input  id="pin" class="block mt-1 w-full  {{ $errors->has('pin') ? 'border-red-500' : 'border-gray-300' }}" type="text" name="pin" value="{{ old('pin', $accounts->pin) }}" required />
                            @if ($errors->has('pin'))
                                <p class="text-red-500 mt-2 text-xs ">{{ $errors->first('pin') }}</p>
                            @endif
                        </div>

                        <div>
                            <x-input-label for="bank_balance" :value="__('Bank Balance')" />
                            <x-text-input  id="bank_balance" class="block mt-1 w-full {{ $errors->has('bank_balance') ? 'border-red-500' : 'border-gray-300' }}" type="text" name="bank_balance" value="{{ old('bank_balance', $accounts->bank_balance) }}" readonly />
                            @if ($errors->has('bank_balance'))
                                <p class="text-red-500 mt-2 text-xs ">{{ $errors->first('bank_balance') }}</p>
                            @endif
                        </div>

                        <div>
                            <x-primary-button class="">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
