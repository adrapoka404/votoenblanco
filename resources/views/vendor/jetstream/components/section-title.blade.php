<div class="text-white font-light bg-red-800">
    <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium text-white py-2 pl-20">{{ $title }}</h3>
        <p class="mt-1 text-sm text-gray-600">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
