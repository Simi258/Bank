@props(['accounts'])
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between ">
            <div class="flex items-center">
                <div>
                    <img src="{{ asset('storage/freelancer.png') }}"  alt="transaction" class="mr-2">
                </div>
                <h1 class="text-2xl font-bold text-gray-800 ml-4">Employer Information</h1>
            </div>
            <div class="flex mt-4 lg:mt-0">
                <div class="flex items-center">
                    <a href="{{ route('employers') }}" class="text-sm text-gray-600 underline">Go Back</a>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="py-12 ">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white border border-indigo-400 rounded-lg  overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <div>
                        <div class="flex ">
                            <img src="https://eu.ui-avatars.com/api/?name={{ $employers->name }}&background=F1C550" class="h-12 rounded-full mr-2 ">
                            <h2 class="text-xl font-bold pt-2">Name:</h2>
                            <p class="text-lg mt-2 ml-2 border-b text-gray-600 border-gray-300">{{ $employers->name }}</p>
                            <h2 class="ml-12 mt-2 text-xl font-bold ">Username:</h2>
                            <p class="text-lg mt-2 ml-2 border-b text-gray-600 border-gray-300">{{ $employers->username }}</p>
                        </div>
                        <div class="flex">
                            <h2 class="text-xl font-bold ml-14 pt-2">Email:</h2>
                            <p class="text-lg mt-2 ml-2 border-b text-gray-600 border-gray-300">{{ $employers->email}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
