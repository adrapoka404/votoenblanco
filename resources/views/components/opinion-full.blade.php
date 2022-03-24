    <div class=" grid grid-cols-2">
        <div class="mx-auto">
            <a href="{{ route('notas.editores', 'editor') }}">
                <img class=" w-52 h-52 rounded-full object-cover object-center mb-4 "
                    src="https://picsum.photos/seed/picsum/700/400" alt="Image Size 720x400" />
            </a>
        </div>
        <div class="text-left mt-10">
            <div class="ml-5 my-auto">
                <div class="text-red-800">Nombre del colab.</div>
                <div>Especialidad</div>
                <div>
                    <a href="{{ route('notas.editores', 'editor') }}"
                        class="bg-red-800 px-10 text-white rounded-lg font-semibold">notas y aportaciones</a>
                </div>
            </div>
        </div>
    </div>
