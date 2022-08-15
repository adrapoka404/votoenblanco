<x-row-form>
    <x-label-form>
        {!! Form::label('editor.name', 'Nombre:', ['class' => '']) !!}
        <x-help-form>Nombre o alias para mostrar en el sitio público</x-help-form>
        @error('name')
        <x-has-error>{{$message}}</x-has-error>
        @enderror
    </x-label-form>
    <x-input-form>
        {!! Form::text('editor[name]', old('editor.name') ? old('editor.name') : (isset($editor) ? $editor->name: '' ), [
            'class' =>
                'border-2 border-wine focus:border-wine rounded-md mt-1 md:inline items-start ring-1 ring-wine w-full mx-auto ',
            'placeholder' => __('Raymundo River@'),
            'autofocus',
        ]) !!}
    </x-input-form>
</x-row-form>

<x-row-form>
    <x-label-form>
        {!! Form::label('editor.email', 'Correo electrónico:', ['class' => '']) !!}
        <x-help-form>Este correo debe ser unico y se creara un usuario para acceder al sitio</x-help-form>
        @error('email')
        <x-has-error>{{$message}}</x-has-error>
        @enderror
    </x-label-form>
    <x-input-form>
        {!! Form::email('editor[email]', old('editor.email') ? old('editor.email') : (isset($editor) ? $editor->email: '' ), [
            'class' =>
                'border-2 border-wine focus:border-wine rounded-md mt-1 md:inline items-start ring-1 ring-wine  w-full mx-auto ',
            'placeholder' => __('username@dominio.mx'),
        ]) !!}
    </x-input-form>
</x-row-form>
<x-row-form>
    <x-label-form>
        {!! Form::label('specialty', 'Especialidad:', ['class' => '']) !!}
        <x-help-form>Dile a los lectores la especialidad del Editor</x-help-form>
        @error('specialty')
        <x-has-error>{{$message}}</x-has-error>
        @enderror
    </x-label-form>
    <x-input-form>
        {!! Form::text('editor[specialty]', old('editor.specialty') ? old('editor.specialty') : (isset($editor) ? $editor->specialty: '' ), [
            'class' =>
                'border-2 border-wine focus:border-wine rounded-md mt-1 md:inline items-start ring-1 ring-wine  w-full mx-auto ',
            'placeholder' => __('marketing empresarial'),
        ]) !!}
    </x-input-form>
</x-row-form>
<x-row-form>
    <x-label-form>
        {!! Form::label('editor.semblance', 'Semblanza:', ['class' => '']) !!}
        <x-help-form>Dile a tus lectores un poco sobre el Editor</x-help-form>
        @error('semblance')
        <x-has-error>{{$message}}</x-has-error>
        @enderror
    </x-label-form>
    <x-input-form>
        {!! Form::textarea('editor[semblance]', old('editor.semblance') ? old('editor.semblance') : (isset($editor) ? $editor->semblance: '' ), [
            'class' =>
                'border-2 border-wine focus:border-wine rounded-md mt-1 md:inline items-start ring-1 ring-wine  w-full mx-auto ',
            'placeholder' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam atque nulla autem optio libero! Excepturi reprehenderit assumenda est eum alias omnis modi! Inventore officia commodi voluptatem. Autem accusamus aspernatur repellat.', 
            'rows' => 5,
        ]) !!}
    </x-input-form>
</x-row-form>
<x-row-form>
    <x-label-form>
        {!! Form::label('editor.status', 'Estado:', ['class' => '']) !!}
        @error('status')
        <x-has-error>{{$message}}</x-has-error>
        @enderror
    </x-label-form>
    <x-input-form>
        {!! Form::select('editor[status]', ['0' => 'Desactivado', '1' => 'Activado'], old('editor.status') ? old('editor.status') : (isset($editor) ? $editor->status: '' ), [
            'class' =>
                'border-2 border-wine focus:border-wine rounded-md mt-1 md:inline items-start ring-1 ring-wine  w-full mx-auto ',
        ]) !!}
    </x-input-form>
</x-row-form>
<x-jet-validation-errors />
@section('js')
    <script>
        $(document).ready(function() {
            console.log('adrapok de chibalba');
        })
    </script>
@endsection
