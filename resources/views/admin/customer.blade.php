@props(['account'])
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('storage/user.png') }}" class="h-12 w-12 mr-4">
                <h2 class="text-xl font-bold">User Information</h2>
            </div>
            <a href="{{ route('admin') }}" class="text-sm text-gray-600 underline">Go Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-indigo-400 overflow-hidden shadow-sm sm:rounded-lg">
                @if (session()->has('deleted'))
                        <strong class="font-bold">Success!</strong>
                    <div class="text-green-700 mb-4  rounded relative" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 10000)" x-show="show">
                    <span class="block sm:inline">{{ session('deleted') }}</span>
                    </div>
                @endif

                <div class="flex float-right mr-8 mt-4">
                    <h2 class="text-xl ml-14 font-semibold"> Total number of Users:</h2>
                    <h2 class="ml-4 text-lg ">{{ $customers->count() }}</h2>
                </div>

                <div class="pb-2">
                    <div class="text-xl font-semibold ml-6 mt-4 text-gray-600 border-b"> Customers: </div>
                </div>

                    @if ($customers->count() > 0)
                        @foreach ($customers as $customer)
                    <x-customer-card
                        :customer="$customer"/>
                    @endforeach

                @else <div class="text-xl text-center mb-4 font-semibold  text-red-600">
                    No Customer Registered
                    </div>
                @endif
                </div>

                <div class="mt-4 mb-4 mr-2 ">
                    {{ $customers->links() }}
                </div>

            </div>
        </div>
</x-app-layout>


