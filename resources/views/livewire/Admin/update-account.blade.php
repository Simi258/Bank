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
        </div>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            @if(Session::has('success'))
                <div class="text-green-700 mb-4  rounded relative" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 10000)" x-show="show">
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

                <form wire:submit.prevent="update">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <x-input-label for="iban" :value="__('IBAN')" />
                        <x-text-input  id="iban" class="block mt-1 w-full  {{ $errors->has('iban') ? 'border-red-500' : 'border-gray-300' }}" type="text" name="iban"  value="{{ $accounts->iban }}"  required wire:model="iban" />
                        <x-input-error :messages="$errors->get('iban')" class="mt-1" />

                    </div>
                    <div>
                        <x-input-label for="pin" :value="__('PIN')" />
                        <x-text-input  id="pin" class="block mt-1 w-full  {{ $errors->has('pin') ? 'border-red-500' : 'border-gray-300' }}" type="text" name="pin"  value="{{ $accounts->pin }}" required wire:model="pin" />
                        <x-input-error :messages="$errors->get('pin')" class="mt-1" />

                    </div>

                    <div>
                        <x-input-label for="bank_balance" :value="__('Bank Balance')" />
                        <x-text-input  id="bank_balance" class="block mt-1 w-full {{ $errors->has('bank_balance') ? 'border-red-500' : 'border-gray-300' }}" type="text" name="bank_balance" value="{{ $accounts->bank_balance }}" readonly />
                        <x-input-error :messages="$errors->get('bank_balance')" class="mt-1" />

                    </div>
                    <div class="flex">
                        <div class="mt-3">
                            <x-primary-button type="submit">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>

                        <x-danger-button class="text-sm ml-2 bg-red-500 text-white mt-3 rounded-lg" wire:click="delete" wire:confirm="Are you sure you want to delete the user?">
                            {{ __('Delete') }}
                        </x-danger-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
