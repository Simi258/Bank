@props(['employer'])

<article
    {{ $attributes->merge(['class' => 'transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl']) }}>
    <div class="py-6 px-5 h-full flex flex-col">


        <div class=" flex flex-col justify-between ">
            <header>
                <a href="{{ route('employ.info-employer', $employer->id ) }}" class="text-lg  list-disc pl-4 pt-5 ">
                <div>
                    <img src="https://eu.ui-avatars.com/api/?name={{ $employer->name }}&background=B4D6BC" alt="employer" class="rounded-full size-12  float-left">
                </div>
                <div class="ml-4 mr-2 pl-11 mb-2 border-b">
                    <h1 class="text-xl clamp one-line">
                            {!! $employer->name !!}
                    </h1>
                    <h2 class="text-m clamp one-line">
                        {{ $employer->email }}
                    </h2>
                </div>
                </a>
            </header>
        </div>
    </div>
</article>
