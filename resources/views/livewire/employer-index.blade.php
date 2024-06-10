
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <img src="{{ asset('storage/team.png') }}" class="h-12 w-12 mr-4">
                <h2 class="text-xl font-bold">Employer </h2>
            </div>
            <form method="GET">
                <div class="flex items-center">
                    <input name="search" wire:model.live="search" type="search" class="px-4 py-2 border rounded-l-full" placeholder="Search employers...">
                    <button type="submit" class="px-4 py-2 border rounded-r-full bg-indigo-500 text-white">Search</button>
                    <div>
                        <a href="{{route('accounts')}}" class=" ml-4 pt-2 text-sm text-gray-600 underline">Go back</a>
                    </div>
                </div>
            </form>

        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-indigo-400 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex float-right mr-8 mt-4"> <h2 class="text-xl ml-14 font-semibold"> Total number of Users:
                    </h2>
                    <h2 class="ml-4 text-lg "> {{ $employers->count() }}
                    </h2>
                </div>
                <div class="pb-4">
                    <div class="text-xl font-semibold mt-8 ml-6 border-b text-gray-600">
                        Customers: </div> </div> @if ($employers->count() > 0 ) @foreach ($employers as $employer)
                    <x-employer-card :employer="$employer" /> @endforeach
                <div class="mt-4 mb-4 ml-2 mr-2   ">
                    {{ $employers->links('vendor.pagination.tailwind') }}
                </div>
                @else

                    <div class="text-xl text-center mb-4 font-semibold text-red-600"> No Customer Registered

                    </div> @endif
            </div>
        </div>
    </div>

