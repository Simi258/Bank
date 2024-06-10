<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="text-2xl text-indigo-600 font-bold">Message from: <span class="text-xl text-slate-900">{{ $message->name }}</span></h1>
                <p class="text-2xl font-medium pl-2"> </p>
            </div>
            <div class="basis-4/6 ">
                <a href="{{ route('admin/customer-messages') }}" class="float-right text-sm text-gray-600 underline mt-2">Go Back </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-indigo-400 rounded-lg overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 pb-12 border-b-4">
                    <div class="flex justify-between">
                        <h2 class="text-2xl font-bold">Message Detail</h2>
                        <h2 class="order-last mt-2 text-slate-400">{{ $message->created_at->format('d/m/y h:m a') }}</h2>
                    </div>
                    <div class="w-96">
                        <h2 class="mt-4 text-lg font-semibold">Email:</h2>
                        <p class="border-b text-m text-gray-500 w-full">{{ $message->email }}</p>
                        <h2 class="mt-4 text-lg font-semibold">Message:</h2>
                        <p class="border-b w-full text-m text-gray-500 ">{{ $message->message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
{{-- --}}
