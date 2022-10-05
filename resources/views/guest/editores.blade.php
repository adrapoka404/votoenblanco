<x-guest-layout>
    <x-liston>{{ __('nuestras letras') }}</x-liston>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-3 gap-4">
        @foreach ($editores as $i => $editor)
            @if (fmod($i, 2) == 0)
                <div class="col-span-3 md:col-span-2">
                    <x-opinion-full>
                        <x-slot name="href">{{ route('notas.editores', $editor->user->slug) }}</x-slot>
                        <x-slot name="name">{{ $editor->user->name }}</x-slot>
                        <x-slot name="specialty">{{ $editor->specialty }}</x-slot>
                        <x-slot name="src">{{ $editor->user->profile_photo_url }}</x-slot>
                    </x-opinion-full>
                </div>
                <div></div>
            @else
                <div></div>
                <div class="col-span-3 md:col-span-2">
                    <x-opinion-full>
                        <x-slot name="href">{{ route('notas.editores', $editor->user->slug) }}</x-slot>
                        <x-slot name="name">{{ $editor->user->name }}</x-slot>
                        <x-slot name="specialty">{{ $editor->specialty }}</x-slot>
                        <x-slot name="src">{{ $editor->user->profile_photo_url }}</x-slot>
                    </x-opinion-full>
                </div>
            @endif
        @endforeach
    </div>
</x-guest-layout>
