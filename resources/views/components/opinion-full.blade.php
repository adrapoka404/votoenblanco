    <div class=" grid grid-cols-2">
        <div class="mx-auto">
            <a href="{{$href}}">
                <img class=" w-52 h-52 rounded-full object-cover object-center mb-4 "
                    src="{{$src}}" alt="{{$name}}" />
            </a>
        </div>
        <div class="text-left mt-10">
            <div class="ml-5 my-auto">
                <div class="text-red-800">{{$name}}</div>
                <div>{{$specialty}}</div>
                <div>
                    <a href="{{ $href }}"
                        class="bg-red-800 md:px-10 block text-white text-center rounded-lg font-semibold ">notas y aportaciones</a>
                </div>
            </div>
        </div>
    </div>
