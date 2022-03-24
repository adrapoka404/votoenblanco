<div {{ $attributes->merge(['class' => 'max-w-7xl mx-auto px-4 sm:px-6 lg:px-8']) }}>
    
    <x-jet-section-title>
        <x-slot name="title"><span class=" uppercase">{{ $title }}</span></x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-jet-section-title>
    <div class="mt-5">
            {{ $content }}       
    </div>
</div>
