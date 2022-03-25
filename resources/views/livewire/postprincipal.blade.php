<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 my-10">
    <div class="text-center items-center">
        <div class="text-red-800 text-3xl font-bold mb-5 w-full">Cabeza de nota</div>
        <img src="{{asset('img/nota.png')}}" alt="  " class=" w-96 mx-auto border border-gray-light h-80">
        
    </div>
    <div class=" text-justify mt-16 my-2">
            <span class="py-2 my-3 ">Voto en blanco (22 de febrero de 2022) ll Redacción</span>
            <p class="sumary my-3">
                ipsum dolor sit amet consectetur adipisicing elit. Excepturi itaque veniam, assumenda et sint enim nobis
                ab voluptates tenetur ad optio eligendi. Natus quo mollitia dignissimos at ab, laborum fugiat.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore unde magnam praesentium cupiditate molestias non, libero nostrum. Totam quam praesentium quas hic enim dignissimos quasi obcaecati, in ratione sequi ex.
            </p>
            <a href ="{{route('notas.show', 'adx')}}" class="bg-red-800 px-10 text-white rounded-lg font-semibold">leer más</a>
    </div>
    <div class="mx-2">
        <div class="ml-5 text-red-800 font-extralight text-3xl">Destacadas:</div>
        <x-link-destacadas />
        <x-link-destacadas />
        <x-link-destacadas />
        <x-link-destacadas />

        
    </div>
</div>
