<div class="flex justify-between items-center">
    <div class="flex items-center">
        @if ($image)
            <img src="{{ $image }}" class="h-12 w-12 mr-4">
        @endif
        <h2 class="text-xl font-semibold text-gray-800">
            {{ $title }}
        </h2>
    </div>
    @if ($actions)
        <div class="flex items-center">
            {{ $actions }}
        </div>
    @endif
</div>
