<div class="flex flex-col">
    <div class="my-5 text-right" id="Lista de carpetas">
        {!! Form::open(['route' => 'services.imagen_upload', 'id' => 'formUploadImages']) !!}
        {!! Form::file('subir', [
            'class' => 'hidden',
            'id' => 'uploadFile',
            'accept' => 'image/png, image/gif, image/jpeg',
            'onchange' => 'actionUploadImage()'
        ]) !!}
        {!! Form::hidden('upload_in', '', ['id' => 'uploadIn']) !!}
        <span class="bg-green px-3 py-2 rounded-full cursor-pointer" id="uploadButton" onclick="$('#uploadFile').click();">Subir Imagen adx</span>
        {!! Form::close() !!}
        <div class=" text-red-200 text-xs" id="upload_errors"></div>
    </div>
</div>
<div class="flex flex-col md:flex-row ">
    <div id='popup_directories' class="border-r-4 border-wine">

    </div>
    <div id="popup_images"
        class="grid grid-cols-1 gap-1 md:grid-cols-2 md:gap-2 lg:grid-cols-4 lg:gap-4 overflow-y-auto h-96 overflow-x-hidden">

    </div>
</div>