@props(['customer'])
<article
    {{ $attributes->merge(['class' => 'transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl']) }}>
    <div class="pb-2 px-5 h-full flex flex-col">
        <div class=" flex flex-col border-b justify-between ">
            <header>
                <a href="{{ route('admin.customer-info', $customer->id ) }}" class="text-lg  list-disc pl-4 pt-5 ">
                    <div>
                        <img src="https://eu.ui-avatars.com/api/?name={{ $customer->name }}&background=dec0f1" alt="user" class="rounded-full size-12 mb-2 float-left">
                    </div>
                    <div class=" ml-4 pl-11">
                        <h1 class="text-xl clamp one-line">
                            {{ $customer->name }}
                        </h1>
                        <h2 class="text-m clamp one-line">
                            {{ $customer->email }}
                        </h2>
                    </div>
                </a>
            </header>
        </div>
    </div>
</article>

