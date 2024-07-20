<div class="grid grid-cols-3 gap-6">
    <div class="col-span-3 sm:col-span-3">
        <x-label for="input-{{ $attributes->get('name') }}" class="{{ $attributes->get('class') }}"
            value="{{ $attributes->get('label') }}">
        </x-label>

        <div class="mt-1 flex rounded-md shadow-sm">
            @if ($attributes->has('add-on'))
                <span
                    class="inline-flex items-center px-3 border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                    {{ $attributes->get('add-on') }}
                </span>
            @endif
            <x-input
                {{ $attributes->merge([
                    'id' => 'input-' . $attributes->get('name'),
                    'type' => $attributes->get('type', 'text'),
                ]) }} />
        </div>
        @error($attributes->get('name'))
            <x-validation-message>
                {{ $message }}
            </x-validation-message>
        @enderror
    </div>
</div>
