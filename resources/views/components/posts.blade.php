<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 my-10">
    <div class="text-center items-center">
        <div class="text-red-800 text-3xl font-bold mb-5 w-full capitalize">{{$title}}</div>
        <img src="{{$src}}" alt="{{$alt}}" class=" w-96 mx-auto border border-gray-light h-80 ">
        
    </div>
    <div class="text-center mt-16">
            <span class="py-2 my-3 ">Voto en blanco ({{$date}})) <a href="{{$userto}}">{{$user}}</a></span>
            <p class="sumary my-3">
                {{$sumary}}
            </p>
            <a href ="{{$where}}" class="bg-red-800 px-10 text-white rounded-lg font-semibold">leer más</a>
    </div>
</div>