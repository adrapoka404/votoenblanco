<x-guest-layout>
    <div class="w-full">
        @if ($who == 'editor')
            <x-semblanza />
        @endif
        <div class="">
            <x-posts />
            <x-posts />
            <x-posts />
            <x-posts />
            <x-posts />
        </div>
    </div>
</x-guest-layout>
