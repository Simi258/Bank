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
                    <div class="text-green-700 mb-4  rounded relative" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 10000)" x-show="show">
                        <strong>{!! Session::get('status') !!}</strong>
                    </div>
                @endif
                <form wire:submit.prevent="create">
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model.lazy="name" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    <div class="mb-4">
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" wire:model.lazy="username" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('username')"  />
                        </div>

                    <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" wire:model.lazy="email" required autofocus autocomplete="email" />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                    <div class="mb-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" wire:model.lazy="password" required autofocus autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')"  />
                        </div>

                    <div class="mb-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" wire:model.lazy="password_confirmation" required autofocus autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_conformation')"  />
                        </div>

                    <div class="mt-6">
                        <button  class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto sm:text-sm">
                            {{ __('Add User') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
