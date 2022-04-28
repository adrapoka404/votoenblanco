@if (session('info'))
    <div {{ $attributes }}>
        <div class="font-medium text-green">{{ __('Éxito! Todo salio bien.') }}</div>

        <p class="mt-3 list-disc list-inside text-sm text-green">
                {{ session('info') }}
        </p>
    </div>
@endif
