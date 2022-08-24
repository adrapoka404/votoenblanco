<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div class="w-full">
            <div class="w-full flex py-10">
                <div class="inline w-1/3">
                    <div class="w-28 h-28 bg-no-repeat bg-contain text-center mx-auto"
                        style="background-image: url({{ asset('img/privacy.png') }})"></div>
                </div>
                <div class="inline w-2/3">
                    <div class="border-b-4 border-b-wine text-4xl px-5 py-8 capitalize"> privacidad y contraseña</div>
                </div>
                
            </div>
            
            
        </div>
    </div>
</x-app-layout>
