
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg px-6 p-4">
                @if (session('success'))
                    <div class=" text-green-700  pb-2 rounded relative" role="alert" x-data="{show: true}" x-init="setTimeout(() => show = false, 7000)" x-show="show">
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
                    <div>
                        <form wire:submit.prevent="update">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input  id="name" class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} " type="text" name="name" value="{{ $user->name }}"  required wire:model="name" />
                                    <x-input-error :messages="$errors->get('name')"  />
                                </div>
                                <div>
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input  id="email" class="block mt-1 {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} w-full " type="email" name="email" value="{{ $user->email  }}" required wire:model="email" />
                                    <x-input-error :messages="$errors->get('email')"  />
                                </div>

                                <div>
                                    <x-input-label for="username" :value="__('Username')" />
                                    <x-text-input  id="username" class="block mt-1 {{ $errors->has('username') ? 'border-red-500' : 'border-gray-300' }} w-full " type="text" name="username" value="{{ $user->username }}" required wire:model="username" />
                                    <x-input-error :messages="$errors->get('username')"  />

                                </div>


                                <div>
                                    <x-input-label  for="user_type" :value="__('User Type')" />
                                    <select id="user_type" class="block mt-1 w-full" name="user_type" required wire:model="user_type">
                                        <option value="employer" {{ 'user_type' == 'employer' ? 'selected' : '' }}>Employer</option>
                                        <option value="customer" {{ 'user_type' == 'customer' ? 'selected' : '' }}>Customer</option>
                                    </select>
                                </div>
                                <div class="flex">
                                    <div class="mt-3">
                                        <x-primary-button type="submit">
                                            {{ __('Update') }}
                                        </x-primary-button>
                                    </div>

                                    <x-danger-button class="text-sm ml-2 bg-red-500 text-white mt-3 rounded-lg" wire:click="delete" wire:confirm="Are you sure you want to delete the user?">
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
        </div>
    </div>




