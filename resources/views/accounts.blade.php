    <x-app-layout>
            <x-slot name="header">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/user.png') }}" class="h-12 w-12 mr-4">
                        <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name}}</h2>
                    </div>
                    @if(Session::has('status'))
                        <div class="text-green-700 rounded relative" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 10000)" x-show="show">
                            <strong>{!! Session::get('status') !!}</strong>
                        </div>
                    @endif
                </div>
            </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h1 class="text-3xl font-bold text-gray-800 mb-6">Your Accounts</h1>
                        <a href="{{ route('auth.register-account') }}">
                            <span class="text-sm font-bold">Add New Account</span>
                        </a >
                    </div>
                    <div class="mt-6 border-t border-gray-200">
                        <div class="flex items-center px-4 py-2 text-sm font-medium text-gray-500">
                            <span class="ml-3">Account Information</span>
                        </div>
                        <ul class="space-y-2">
                            @foreach ($accounts as $account)
                                <li class="flex items-center justify-between bg-gray-50 p-4 rounded">
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('dashboard', ['id' => $account->account_id]) }}" class="text-gray-800 text-xl font-bold">
                                            {{ $account->iban }}
                                    </div>
                                    <div class="flex-1 ml-4">
                                        <span class="text-gray-600">Bank Balance:</span>
                                        <span class="text-gray-800 text-xl font-bold">{{ $account->bank_balance. "€" }}</span>
                                    </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="pb-14">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex ">
                    <img src="{{ asset('storage/job-search.png') }}"  alt="Employer" >
                    <a href="{{ route('employers')}}" class="text-zinc-800 text-lg hover:underline list-disc pl-4 pt-5 ">Employer</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
