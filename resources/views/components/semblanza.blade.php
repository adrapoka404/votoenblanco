<div class="bg-gray lg:grid lg:grid-cols-3">
    <div class="lg:col-span-1">
        <img class=" h-52 w-96 lg:w-52 mx-auto object-content object-center mb-4 " src="{{$src}}"
            alt="{{$nombre}}" />
    </div>
    <div class="lg:col-span-2 text-left">
        <div class="ml-5 my-auto">
        <div class="text-red-800 font-semibold text-5xl">{{$nombre}}</div>
        <div class=" text-3xl font-extralight">{{$especialidad}}</div>
        <div class=" text-justify mr-10 mt-10 font-light font-sans ">
            {{$description}}
        </div>
    </div>
    </div>
</div>
