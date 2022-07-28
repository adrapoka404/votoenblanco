<div class="mx-auto flex  my-10 ">
    <div class=" text-center w-1/3  flex-1 pl-10">
        <div class="text-red-800 text-3xl font-bold mb-5 w-full">Cabeza de nota</div>
        <div class="w-full h-80 bg-gray pb-2 bg-contain bg-fixed bg-no-repeat " style="background-image: url('{{asset('img/nota.png')}}')">
            
        </div>
    </div>
    <div class="w-1/3 flex-1 items-center content-center ">
        <div class=" pl-2 pr-5 text-justify"> 
            <span class="py-2 my-3 ">Voto en blanco (22 de febrero de 2022) ll Redacción</span>
            <p class="sumary my-3">
                ipsum dolor sit amet consectetur adipisicing elit. Excepturi itaque veniam, assumenda et sint enim nobis
                ab voluptates tenetur ad optio eligendi. Natus quo mollitia dignissimos at ab, laborum fugiat.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore unde magnam praesentium cupiditate molestias non, libero nostrum. Totam quam praesentium quas hic enim dignissimos quasi obcaecati, in ratione sequi ex.
            </p>
            <a href ="{{route('notas.show', 'adx')}}" class="bg-red-800 px-10 text-white rounded-lg font-semibold">leer más</a>
        </div>
            
    </div>
    <div class="w-1/3 flex-1 pl-10">
        <div class="pl-5 text-red-800 font-extralight text-3xl">Destacadas:</div>
        <x-link-destacadas />
        <x-link-destacadas />
        <x-link-destacadas />
        <x-link-destacadas />

        
    </div>
</div>
