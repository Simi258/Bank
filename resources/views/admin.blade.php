
<x-app-layout>
    <x-slot name="header">
        <x-header title="Admin" image="{{ asset('storage/authorize.png') }}" actions=""/>
    </x-slot>

    <!-- loop to render the admin dashboard items -->
    @foreach($dashboardItems as $item)
        <div class=" pt-4 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex">
                        <img src="{{ asset("storage/{$item['icon']}") }}" alt="{{$item['alt']}}">
                        <a href="{{ route($item['route']) }}" class="text-blue-600 text-lg hover:underline list-disc pl-4 pt-5">{{$item['label']}}</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
