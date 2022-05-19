<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white px-5 " style="width:100%">
                <div class="">
                    <div class="@if($profile->cover != null) bg-[url( {{ $profile->cover}} )] @else bg-black @endif px-5 items-center text-center mx-auto ">
                        <label for="file">
                            <img src="{{ asset($user->profile_photo_url) }}" alt="{{ $user->name }}"
                                class="mx-auto w-52 h-52 rounded-full py-3 px-3 cursor-pointer" id="img_category">
                        </label>
                        <div>
                            <label class = 'cursor-pointer text-gray-dark text-left' for="portada">Lapicito</label>
                        </div>
                    </div>
                    {!! Form::model($user, ['route' => ['admin.editor.profile.update', $user], 'method' => 'put', 'files' => true, 'atocomplete' => 'off']) !!}
                    <div class=" grid grid-cols-2 gap-4 mt-8">
                        
                        <div class="col-span-2 ">
                            <x-info/>
                            @error('profile.cover')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                            @error('profile.photo')
                            <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>

                        <div class="">

                            {!! Form::text('user[name]', $user->name, ['class' => ' border-wine rounded-lg mr-5 w-96', 'placeholder' => 'Nombre y apellido']) !!}
                            @error('user.name')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[position]', $profile->position, ['class' => ' border-wine rounded-lg ml-5 w-96', 'placeholder' => 'Cargo']) !!}
                            @error('profile.position')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        
                        <div class="">
                            {!! Form::text('profile[signature]', $profile->signature, ['class' => ' border-wine rounded-lg mr-5 w-96', 'placeholder' => 'Alias/Firma']) !!}
                            @error('profile.signature')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[email]', $profile->email, ['class' => ' border-wine rounded-lg ml-5 w-96', 'placeholder' => 'Correo electrónico']) !!}
                            @error('profile.email')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[profession]', $profile->profession, ['class' => ' border-wine rounded-lg mr-5 w-96', 'placeholder' => 'Profesión']) !!}
                            @error('profile.profession')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                                
                            {!! Form::text('profile[speciality]', $profile->speciality, ['class' => ' border-wine rounded-lg ml-5 w-96', 'placeholder' => 'Especialidad']) !!}
                            @error('profile.speciality')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="col-span-2 ">
                            {!! Form::textarea('profile[semblance]', $profile->semblance, ['class' => ' border-wine rounded-lg w-full', 'rows' => '4', 'placeholder' => 'Semblanza']) !!}
                            @error('profile.semblance')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[birthday]', $profile->birthday, ['class' => ' border-wine rounded-lg mr-5 w-96', 'placeholder' => 'Fecha de nacimiento (dd/mm/aaaa)']) !!}
                            @error('profile.birthday')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[mobile]', $profile->mobile, ['class' => ' border-wine rounded-lg ml-5 w-96', 'placeholder' => 'Teléfono']) !!}
                            @error('profile.mobile')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[fb]', $profile->fb, ['class' => ' border-wine rounded-lg mr-5 w-96', 'placeholder' => 'Link a Facebook']) !!}
                            @error('profile.fb')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[tw]', $profile->tw, ['class' => ' border-wine rounded-lg ml-5 w-96', 'placeholder' => 'Link a Twitter']) !!}
                            @error('profile.tw')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[yt]', $profile->yt, ['class' => ' border-wine rounded-lg mr-5 w-96', 'placeholder' => 'Link a YouTube']) !!}
                            @error('profile.yt')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[tt]', $profile->tt, ['class' => ' border-wine rounded-lg ml-5  w-96', 'placeholder' => 'Link a TikTok']) !!}
                            @error('profile.tt')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            {!! Form::text('profile[personal]', $profile->personal, ['class' => ' border-wine rounded-lg mr-5 w-96', 'placeholder' => 'Link a sitio personal']) !!}
                            @error('profile.personal')
                                <x-input-error>{{ $message }}</x-input-error>
                            @enderror
                        </div>
                        <div class="">
                            <input type="hidden" name="user[user_id]" value="{{$user->id}}">
                            <input type="file" id="file" class=" hidden" name="profile[photo]"
                                value="{{ $profile->photo }}">
                                <input type="file" id="portada" class=" hidden" name="profile[cover]"
                                value="{{ $profile->cover }}">
                        </div>
                        <div class="col-span-2 text-center">
                            {!! Form::submit(__('Actualizar'), ['class' => 'text-white bg-wine px-16 py-1 cursor-pointer ']) !!}
                        </div>
                        
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
