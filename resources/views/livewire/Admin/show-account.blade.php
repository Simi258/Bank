
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <div class="rounded-full p-1">
                    <img src="https://eu.ui-avatars.com/api/?name={{ $user->name }}&background=dec0f1" class=" rounded-full h-12 w-12 mr-2">
                </div>
                <h2 class="text-xl font-bold text-gray-800 ">
                    <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                </h2>
            </div>
            <a href="{{ route('admin.customer-info', $user->id ) }}" class="text-sm text-gray-600 underline ">Go Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                @if ($errors->any())
                    <div class=" text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(Session::has('deleted'))
                        <div class="text-green-700 mb-4  rounded relative" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 10000)" x-show="show">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ Session::get('deleted') }}</span>
                    </div>
                @endif
                <div class="flex items-center mb-6">
                    <img src="https://eu.ui-avatars.com/api/?name={{ $user->name }}&background=b3dee2" class="h-12 rounded-full mr-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->username }}</p>
                    </div>
                </div>
                <ul class="space-y-2">
                    @foreach ($accounts as $account)
                        <li class="flex items-center justify-between bg-gray-50 p-4 rounded">
                            <div class="flex-shrink-0">
                                <a href="{{ route('admin/update-account', ['user' => $user->id, 'id' => $account->account_id]) }}" class="text-gray-800 text-xl font-bold"> {{ $account->iban }}
                            </div>
                            <div class="flex-1 ml-4">
                                <span class="text-gray-600">Bank Balance:</span>
                                <span class="text-gray-800 text-xl font-bold">{{ $account->bank_balance. "€" }}</span>
                            </div>
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

