<div class="py-12">
    <div class="max-w-xl mx-auto border-indigo-400 sm:px-6 lg:px-8">
        <div class="bg-white border  border-indigo-400  shadow-md rounded-md p-8  max-w-xl mx-auto">
            @if(session()->has('success'))
                <div class="text-green-700 mb-4  rounded relative" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 10000)" x-show="show">
                    {{ session('success') }}
                </div>
            @endif
            <form wire:submit="submit" >
                <div class="mb-6">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block w-full mt-1" type="text" name="name" wire:model="name" required readonly autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block w-full mt-1" type="email" name="email" wire:model="email"    readdonly autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mb-6">
                    <x-input-label for="message" :value="__('Message')" />
                    <textarea class="block w-96 mt-1" name="message" wire:model="message" required></textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                </div>
                <div class="flex justify-end">
                    <x-primary-button class="ms-4" wire:loading.attr="disabled">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</div>
