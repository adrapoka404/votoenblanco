<div class="my-10 inline-flex">
    <div class="w-2/3 text-center items-center">
        <div class="Header nota my-5">
            <div class="text-red-800 text-3xl font-bold mb-5 w-full">Designan al nuevo fiscal del EDOMEX</div>
            <div class=" left-0 text-left my-5">Nombre del redactor</div>
            <div class=" w-4/5 mx-auto border bg-gray border-gray-light text-center">
                <img src="{{ asset('img/nota.png') }}" alt="  " class=" ">
            </div>
        </div>

        <div class="nota body text2xl">
            <div class="py-2 my-3 text-justify">Voto en blanco (22 de febrero de 2022) ll Redacción</div>
            <p class="sumary my-3 text-justify">
                ipsum dolor sit amet consectetur adipisicing elit. Excepturi itaque veniam, assumenda et sint enim nobis
                ab voluptates tenetur ad optio eligendi. Natus quo mollitia dignissimos at ab, laborum fugiat.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore unde magnam praesentium cupiditate
                molestias non, libero nostrum. Totam quam praesentium quas hic enim dignissimos quasi obcaecati, in
                ratione sequi ex.
            </p>
            <p class="sumary my-3 text-justify">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate quia, amet cumque deleniti autem esse
                quisquam quidem alias laudantium nulla aspernatur libero, reprehenderit eum rem fugiat minus reiciendis
                nemo perferendis!
            </p>

            <div class=" w-4/5 mx-auto border border-gray-light">
                <img src="{{ asset('img/nota.png') }}" alt="  " class=" ">
                <div class="text-right font-semibold">Estos son los créditos</div>
                <div class=" text-sm">Este es un pie de foto</div>
            </div>

            <div class=" text-left subtitulo font-semibold">Este es un subtitulo 2</div>
            <p class="sumary my-3 text-justify">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis officiis consequatur pariatur totam
                quaerat deserunt dolorum cum! Hic velit, tempore distinctio, quasi sequi eum natus placeat suscipit, quo
                labore veniam!

            </p>
            <div class=" text-left subtitulo font-semibold">Este es un subtitulo 2</div>
            <p class="sumary my-3 text-justify">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eligendi, deleniti repellat amet quae itaque
                libero nostrum sint excepturi earum! Sint ad libero dolor fugit et doloribus ipsa modi, cumque possimus?

            </p>
            <p class="sumary my-3 text-justify">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam perspiciatis fugiat animi, expedita, at
                a quod ut repudiandae mollitia facere veniam harum iure ipsam eveniet sapiente, ipsa voluptas voluptates
                repellat?

            </p>

        </div>
    </div>

    <div class="w-1/3">
        <div class="ml-5 text-red-800 font-extralight text-3xl">Relacionadas:</div>
        <livewire:relacionadas />
        <div class="ml-5 h-96 bg-black text-white text-center">Publicidad</div>
    </div>
</div>
<div class="bg-black  my-auto h-96 text-white text-center mb-10">
    Publicidad
</div>
<div class="py-10">
    <x-title-dark>Comentarios</x-title-dark>
    <x-coment-post></x-coment-post>
    <x-coment-post></x-coment-post>
    <x-coment-post></x-coment-post>
    <x-coment-post></x-coment-post>
    <x-coment-post></x-coment-post>
</div>
<div class="">
    <x-title-dark>¿Te ha gustado esta nota?</x-title-dark>
    <div class="flex text-center mx-10 my-16">
        <div class="w-1/2 cursor-pointer my-10 ">
            <img src="{{ asset('img/guardar.png') }}" alt="" id="guarda" class="inline">
            <label for="guarda" class="ml-5 font-bold text-3xl">Guarda</label>
        </div>
        <div class="w-1/2 cursor-pointer my10 text-left">
            <img src="{{ asset('img/compartir.png') }}" alt="" id="comparte" class="inline">
            <label for="comparte" class=" ml-5 font-bold text-3xl">Comparte</label>
        </div>
    </div>
</div>
<div class="py-10">
    <x-title-dark>¿Cúal es tu reacción?</x-title-dark>

</div>
