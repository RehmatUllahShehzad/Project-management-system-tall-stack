<div class="grid grid-cols-3 gap-6">
    <div class="col-span-3 sm:col-span-3">
        <x-label 
            for="input-{{ $attributes->get('name') }}" 
            class="{{ $attributes->get('class') }}"
            value="{{ $attributes->get('label') }}"
            >
        </x-label>

        <div class="mt-1 flex rounded-md shadow-sm">
            @if ( $attributes->has('add-on') )
                <span class="inline-flex items-center px-3 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    {{  $attributes->get('add-on') }}
                </span>
            @endif

            <select
                type="{{ $attributes->has('type') ? $attributes->get('type') : 'text' }}"
                name="{{ $attributes->get('name') }}"
                id="input-{{ $attributes->get('name') }}"
                class="{{ $attributes->merge(['class' => 'focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none sm:text-sm border-gray-300'])->get('class') }}"
                placeholder="{{ $attributes->get('placeholder') }}"
            >
                {{$slot}}
            </select>
        </div>
        @error($attributes->get('name'))
            <x-validation-message>
                {{ $message }}
            </x-validation-message>
        @enderror
    </div>
</div>
