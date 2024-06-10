<div>

        <x-slot name="header">
            <div class="flex flex-col lg:flex-row items-center lg:justify-between ">
                <div class="flex items-center">
                    <div class="rounded-full p-1">
                        <img src="https://eu.ui-avatars.com/api/?name={{ $accounts->name }}&background=dec0f1" class=" rounded-full h-12 w- mr-2 ">
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 ">
                        <h2 class="text-xl font-bold">{{ $accounts->name }} </h2>
                    </h2>
                </div>
                <div class="flex mt-4 lg:mt-0">
                    <div class="flex items-center">
                        <a href="{{ route('admin.customer-info', $accounts->id ) }}" class="text-sm text-gray-600 underline">
                            Go Back
                        </a>
                    </div>
                </div>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-xl mx-auto border-indigo-400 sm:px-6 lg:px-8">
                <div class="bg-white border  border-indigo-400  shadow-md rounded-md p-8  max-w-xl mx-auto">
                    <p class="text-xs font-medium text-gray-600 text-end">Add Account</p>
                    <form wire:submit="store({{ $accounts->id }})" action="{{ route('admin/add-account', ['id' => $accounts->id]) }}">
                        <div class="mb-4">
                            <x-input-label for="iban" :value="__('IBAN')" />
                            <x-text-input id="iban" class="block w-full mt-1" type="text" wire:model.lazy="iban" name="iban" :value="old('iban')" required autofocus autocomplete="iban" />
                            <x-input-error :messages="$errors->get('iban')" class="mt-1" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="pin" :value="__('Pin')" />
                            <x-text-input id="pin" class="block w-full mt-1" type="text" wire:model="pin" name="pin" :value="old('pin')" required autofocus autocomplete="pin" />
                            <x-input-error :messages="$errors->get('pin')" class="mt-1" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="bank_balance" :value="__('Bank Balance')" />
                            <x-text-input id="bank_balance" class="block w-full mt-1" type="text" name="bank_balance" value="00" required autocomplete="bank_balance" readonly />
                            <x-input-error :messages="$errors->get('bank_balance')" class="mt-2" />
                        </div>
                        <div class="flex justify-end">
                            <x-primary-button class="ms-4">
                                {{ __('Add Account') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
