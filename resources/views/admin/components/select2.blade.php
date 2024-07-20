<div wire:ignore>
    <select data-pharaonic="select2" data-component-id="{{ $this->id }}"
        {{ $attributes->merge([
                'class' =>
                    'dark:bg-gray-800 dark:text-white form-input block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm disabled:opacity-50 disabled:cursor-not-allowed',
            ])->class([
                'border-red-400 pr-[37px]' => !!$error,
            ]) }}
        id="select2input" multiple="multiple">
        @if ($options instanceof \Illuminate\Database\Eloquent\Collection) 
            @foreach ($options as $option)
                <option value="{{ $option->id }}">
                    {{ $option->name }}
                </option>
            @endforeach
        @endif
    </select>
</div>

@push('page_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css">
@endpush

@push('page_js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('vendor/pharaonic/pharaonic.select2.min.js') }}"></script>

    <script>
        const selectedOptions = @json($selectedOptions);
        console.log(selectedOptions);
        const selected_options_ids = selectedOptions.map(option => option.id);
        $(document).ready(function() {
            $("#select2input").select2({
                multiple: true,
            });
            $('#select2input').val(selected_options_ids).trigger('change');
        });
    </script>
@endpush
