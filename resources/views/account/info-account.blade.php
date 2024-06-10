<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('storage/profile.png') }}" class="h-12 w-12 mr-4">
                <h2 class="text-xl font-bold">Account Information</h2>
            </div>
            <a href="{{ route('accounts') }}" class="text-sm text-gray-600 underline">Go Back</a>
        </div>
    </x-slot>

    @if ($account->count() > 0
        )<div class="py-12">
        <div class="bg-white border border-indigo-400 shadow-lg p-6 rounded-lg max-w-lg mx-auto">
            <div class="flex items-center mb-6">
                <div class="flex-shrink-0">
                    <img src="https://eu.ui-avatars.com/api/?name={{ Auth::user()->name }}&background=F1C550" class="h-16 w-16 rounded-full">
                </div>
                <div class="ml-4">
                    <h2 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600">{{ Auth::user()->username }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Email:</h2>
                    </div>
                    <div class="text-lg text-gray-600">
                        {{ Auth::user()->email }}
                    </div>
                </div>
                <div class="flex justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Account IBAN:</h2>
                    </div>
                    <div class="justify-end">
                    @foreach($account as $accounts)

                    <div class="text-lg text-gray-600">
                        {{ $accounts->iban }}
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="mt-6">
            </div>
        </div>
    </div>
    @else <div class="text-xl text-center mb-4 font-semibold  text-red-600">
        No Customer Registered
    </div>
    @endif

</x-app-layout>

