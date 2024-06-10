<x-guest-layout>
    <form method="POST" action="{{ route('auth.register-account') }}">
        @csrf

        <!-- Iban -->
        <div>
            <x-input-label for="iban" :value="__('IBAN')" />
            <x-text-input id="iban" class="block mt-1 w-full" type="text" name="iban" :value="old('iban')" required autofocus autocomplete="iban" />
            <x-input-error :messages="$errors->get('iban')" class="mt-2" />
        </div>
        <!-- Pin -->
        <div>
            <x-input-label for="pin" :value="__('Pin')" />
            <x-text-input id="pin" class="block mt-1 w-full" type="text" name="pin" :value="old('pin')" required autofocus autocomplete="pin" />
            <x-input-error :messages="$errors->get('pin')" class="mt-2" />
        </div>

        <!-- bank_balance -->
        <div class="mt-4">
            <x-input-label for="bank_balance" :value="__('Bank Balance')" />
            <x-text-input id="bank_balance" class="block mt-1 w-full" type="text" name="bank_balance" value="00" required autocomplete="bank_balance" readonly />
            <x-input-error :messages="$errors->get('bank_balance')" class="mt-2" />
        </div>

<div class="flex mt-4 justify-end">
    <div class="flex items-center justify-end mt-4">

        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{route('accounts')}}">Go Back to Accounts</a>
    </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>

</div>
    </form>
</x-guest-layout>
