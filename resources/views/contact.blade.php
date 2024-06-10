<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('storage/contact.png') }}" class="h-12 w-12 mr-4">
                <h2 class="text-xl font-bold">Contact Us.</h2>
            </div>
        </div>
    </x-slot>
    <livewire:contact-form/>
</x-app-layout>
