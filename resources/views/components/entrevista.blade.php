<div class=" grid grid-cols-2">
    <div class="mx-auto">
        <a href="{{$where}}">
            <img class=" w-52 h-52 object-cover object-center mb-4 "
                src="{{$src}}" alt="Image Size 720x400" />
        </a>
    </div>
    <div class="text-left mt-10">
        <div class="ml-5 my-auto">
            <div class="text-red-800 font-semibold">Descripción</div>
            <div>{{$description}}</div>
            <div>
                <a href="{{$where}}"
                    class="bg-red-800 px-10 text-white rounded-lg font-semibold">Ver más</a>
            </div>
        </div>
    </div>
</div>
