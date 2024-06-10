<x-slot name="header">
    <div class="flex justify-between items-center">
        <div class="flex items-center">
            <img src="{{ asset('storage/user.png') }}" class="h-12 w-12 mr-4">
            <h2 class="text-xl font-bold">User Information </h2>
        </div>
        <form method="GET" class="flex lg:block lg:mt-4">
            <div class="flex items-center lg:flex-row lg:justify-between lg:w-full">
                <div class="lg:w-64 ">
                    <input name="search" wire:model.live="search" wire:click="$refresh" type="search" class="px-4 py-2 border rounded-l-full w-full lg:block lg:mr-2" placeholder="Search employers...">
                </div>
                <div class="lg:w-auto">
                    <button type="submit" class="px-2 py-1 border rounded-r-full bg-indigo-500 text-white sm:px-4 sm:py-2">Search</button>
                </div>
                <div class="lg:w-auto">
                    <a href="{{route('admin')}}" class=" ml-4 pt-2 text-sm text-gray-600 underline">Go back</a>
                </div>
            </div>
        </form>
    </div>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white border border-indigo-400 overflow-hidden shadow-sm sm:rounded-lg">
            @if(Session::has('deleted'))
                <div class="text-green-700 px-4 py-3 rounded relative mt-2" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ Session::get('deleted') }}</span>
                </div>
            @endif
            <div class="flex float-right mr-8 mt-4">
                <h2 class="text-xl sm:text-m ml-14 font-semibold">
                    Total number of Users:
                </h2>
                <h2 class="ml-4 text-lg ">
                    {{ $customers->count()  }}
                </h2>
            </div>
            <div class="pb-2">
                <div class="text-xl font-semibold ml-6 mt-4 mb-2 text-gray-600 border-b"> Customers:
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                @if ($customers)
                    @foreach ($customers as $customer)
                        <x-customer-card :customer="$customer" />
                    @endforeach
                @else
                    <div class="text-xl text-center mb-4 font-semibold text-red-600">
                        No Customer Registered
                    </div>
                @endif
            </div>
            <div class="mt-4 mb-4 m-4 mr-2">
                {{ $customers->links()  }}
            </div>
        </div>
    </div>
</div>
