@props(['account'])
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between ">
            <div class="flex items-center">
                <div class="rounded-full p-1">
                    <img src="https://eu.ui-avatars.com/api/?name={{ $customers->name }}&background=dec0f1" class=" rounded-full h-12 w- mr-2 ">
                </div>
                <h2 class="text-xl font-bold text-gray-800 ">
                    <h2 class="text-xl font-bold">{{ $customers->name }}</h2>
                </h2>
            </div>
            <div class="flex mt-4 lg:mt-0">
                <div class="flex items-center">
                    <a href="{{ route('admin.customer') }}" class="text-sm text-gray-600 underline">
                        Go Back
                    </a>
                </div>

            </div>
        </div>
    </x-slot>

    <div class="py-12 ">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 ">
                <div class="p-6  text-gray-900 ">
                    <div class="bg-white border  border-indigo-400  shadow-md rounded-md p-8  max-w-xl mx-auto">
                        @if(Session::has('success'))
                            <div class="text-green-700 rounded relative mb-4 " role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 10000)" x-show="show">
                                <strong>{!! Session::get('success') !!}</strong>
                            </div>
                        @endif
                            @if ($errors->any())
                                <div class="text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <div class="flex justify-between mb-6">
                            <div class="flex items-center">
                                <img src="https://eu.ui-avatars.com/api/?name={{ $customers->name }}&background=b3dee2" class="h-12 rounded-full mr-2">
                                <h2 class="text-xl font-bold">{{ $customers->name }}</h2>
                            </div>
                            <a href="{{ route('admin/add-account', ['id'=>$customers->id]) }}">
                            <p class="text-xs font-medium text-gray-600">
                                Add Account
                            </p>
                            </a>
                        </div>
                        <div class="flex">
                            <div class="w-1/2">
                                <h2 class="text-xl font-bold mb-2">Profile:</h2>
                                <p class="text-gray-600">Name: {{ $customers->name }}</p>
                                <p class="text-gray-600">Username: {{ $customers->username }}</p>
                                <p class="text-gray-600">Email: {{ $customers->email }}</p>
                            </div>
                            <div class="w-1/2">
                                <h2 class="text-xl font-bold mb-2">Account:</h2>
                                <p class="text-gray-600">
                                    @foreach($customers->accounts as $customer)
                                            {{ "IBAN: ".$customer->iban }}
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="flex">
                        <div class=" mt-6">
                            <a href="{{ route('customers.edit', ['customer' => $customers->id]) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-md">Edit Profile</a>                        </div>
                        <div class=" mt-6 ml-2">
                            <a href="{{ route('admin/show-account', ['user' => $customers->id]) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-md">Edit Account </a>
                    </div>

                </div>
              </div>
             </div>
        </div>
    </div>
</x-app-layout>

{{----}}

