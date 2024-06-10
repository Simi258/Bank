<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row items-center lg:justify-between ">
            <div class="flex items-center">
                <div class="">
                    <img src="{{ asset('storage/add.account.png') }}" alt="email" class="h-12 w-12 mr-4">
                </div>
                <h1 class="text-xl font-bold">Add new user</h1>
            </div>
            <div class="flex mt-4 lg:mt-0">
                <div class="flex flex-row items-center justify-between px-4 py-2">
                    <a href="{{ route('admin') }}" class="text-sm text-gray-600 underline">
                        Go back
                    </a>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(Session::has('status'))
                        <div class=" text-green-700 rounded relative" role="alert">
                            <strong>{!! Session::get('status') !!}</strong>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.register-new-user') }}">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <div class="col-span-1">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus class="mt-1 block w-full py-2 px-3 border border-gray-300 {{ $errors->has('name') ? 'border-red-500' : '' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('name')
                                <p class="text-red-500 text-xs ß">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-1">
                                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                                <input type="text" id="username" name="username" value="{{ old('username') }}" required autocomplete="username" class="mt-1 block w-full py-2 px-3 border border-gray-300 {{ $errors->has('username') ? 'border-red-500' : '' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('username')
                                <p class="text-red-500 text-xs ">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-1">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="mt-1 block w-full py-2 px-3 border border-gray-300 {{ $errors->has('email') ? 'border-red-500' : '' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('email')
                                <p class="text-red-500 text-xs ">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-1">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                <input type="password" id="password" name="password" required autocomplete="new-password" class="mt-1 block w-full py-2 px-3 border border-gray-300 {{ $errors->has('password') ? 'border-red-500' : '' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('password')
                                <p class="text-red-500 text-xs ">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-1">
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="mt-1 block w-full py-2 px-3 border border-gray-300 {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }} bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('password_confirmation')
                                <p class="text-red-500 text-xs ">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                                {{ __('Add User') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
