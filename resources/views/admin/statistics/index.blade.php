<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div class="grid grid-cols-2">
            @if (!empty($masleida)))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas leida
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masleida->views}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masleida->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$masleida->image_principal) }})"></div>
            </div>
            @endif
            @if (!empty($masslike))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas super likeada
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masslike->slikes}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masslike->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$masslike->image_principal) }})"></div>
            </div>
            @endif
            @if (!empty($maslike))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas likeada
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$maslike->likes}}</div>
                </div>
                <div class=" font-light text-sm">{{ $maslike->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$maslike->image_principal) }})"></div>
            </div>
            @endif
            @if (!empty($masnlike))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas no likeada
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masnlike->nlikes}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masnlike->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$masnlike->image_principal) }})"></div>
            </div>
            @endif
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas compartida
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masshare->shareds}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masshare->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$masshare->image_principal) }})"></div>
            </div>

            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    El mas leido
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masleido->vistas}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masleido->user->name }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ $masleido->user->profile_photo_url }})"></div>
            </div>
            
        </div>
    </div>
</x-app-layout>
