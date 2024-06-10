<x-app-layout>

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

        <livewire:admin.customer-edit :user="$user" />
     {{-- <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                @if (session('success'))
                    <div class=" text-green-700  py-3 rounded relative" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 6000)" x-show="show">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="flex items-center mb-6">
                    <img src="https://eu.ui-avatars.com/api/?name={{ $user->name }}&background=b3dee2" class="h-12 rounded-full mr-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-600">{{ $user->username }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.customer-update', ['user' => $user->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input  id="name" class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} " type="text" name="name" value="{{ old('name', $user->name) }}" required />
                            @if ($errors->has('name'))
                                <p class="text-red-500 mt-2 text-xs " >{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <div>
                            <x-input-label for="username" :value="__('Username')" />
                            <x-text-input  id="username" class="block mt-1 w-full {{ $errors->has('username') ? 'border-red-500' : 'border-gray-300' }} " type="text" name="username" value="{{ old('username', $user->username) }}" required />
                            @if ($errors->has('username'))
                                <p class="text-red-500 mt-2 text-xs " >{{ $errors->first('username') }}</p>
                            @endif
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input  id="email" class="block mt-1 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} w-full " type="email" name="email" value="{{ old('email', $user->email) }}" required />
                            @if ($errors->has('email'))
                                <p class="text-red-500 mt-2 text-xs " >{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div>
                            <x-input-label  for="user_type" :value="__('User Type')" />
                            <select id="user_type" class="block mt-1 w-full" name="user_type" required>
                                <option value="employer" {{ $user->user_type == 'employer' ? 'selected' : '' }}>Employer</option>
                                <option value="customer" {{ $user->user_type == 'customer' ? 'selected' : '' }}>Customer</option>
                            </select>
                        </div>

                        <div class="mt-6">

                            <x-primary-button class="">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>--}}
</x-app-layout>
