@props(['messages'])
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('storage/chat.png') }}" class="h-12 w-12 mr-4">
                <h2 class="text-xl font-bold">Messages</h2>
            </div>
            <a href="{{ route('admin') }}" class="text-sm text-gray-600 underline">Go Back</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-y-auto" style="height:auto ;">
                        @if(Session::has('deleted'))
                            <div class="text-green-700 px-4 py-3 rounded relative mt-2" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ Session::get('deleted') }}</span>
                            </div>
                        @endif
                        <table class="w-full table-auto text-justify">
                            <thead>
                            @csrf
                            <td class=" px-4 py-2 border-b text-lg sm:text-s">Messages</td>
                            <td class=" px-4 py-2 border-b"></td>
                            <td class=" px-4 py-2 border-b"></td>
                            <td class=" px-4 py-2 border-b"></td>
                            <td class=" px-4 py-2 border-b">{{ $messages->count() }}</td>
                            <tr>
                                <th class="px-4 py-2">Name of Sender</th>
                                <th class="px-4 py-2">Email of Sender</th>
                                <th class="px-4 py-2">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $message)
                            <tr>
                                <td class="px-4 py-2 text-gray-500 border-b"> {{ $message->name }}</td>
                                <td class="px-4 py-2  text-gray-500 border-b">  {{ $message->email }}</td>
                                <td class="px-4 py-2  text-gray-500 border-b">  {{ $message->created_at->format('d/m/Y h:m a') }}</td>
                                <td class="px-4 py-2 text-gray-500 border-b">

                                    <a href="{{ route('admin/messages-show', ['id' => $message->id]) }}" class="text-sm bg-green-200 px-3 py-1 rounded-lg mr-2">Read</a>
                                </td>
                                <td class="px-4 py-2 text-gray-500 border-b">
                                    <form method="post" action="{{ route('message.delete-and-read', $message->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button class="text-sm bg-red-500 text-white px-3 py-1 rounded-lg">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

