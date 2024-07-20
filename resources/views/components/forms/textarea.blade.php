<div class="grid grid-cols-3 gap-6">
    <div class="col-span-3 sm:col-span-3">
        <x-label
            for="input-{{ $attributes->get('name') }}"
            class="{{ $attributes->get('class') }}"
            value="{{ $attributes->get('label') }}">
        </x-label>
        <div class="mt-1">
            <textarea
                id="input-{{ $attributes->get('name') }}"
                name="{{ $attributes->get('name') }}"
                rows="{{ $attributes->merge(['rows' => 3])->get('rows') }}"
                placeholder="{{ $attributes->get('placeholder') }}"
                class="{{$attributes->merge(['class' => 'shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300'])->get('class') }}">{{ $attributes->get('value') }}</textarea>
        </div>
        <p class="mt-2 text-sm text-gray-500">
            {{ $attributes->get('description') }}
        </p>
        @error($attributes->get('name'))
            <x-validation-message>
                {{ $message }}
            </x-validation-message>
        @enderror
    </div>
</div>
