<div>
    <x-label for="input-{{ $attributes->get('name') }}" class="{{ $attributes->get('class') }}"
        value="{{ $attributes->get('label') }}">
    </x-label>
    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative">
        <div class="space-y-1 text-center">
            
            @if($attributes->get('temporaryUrl'))
                <button 
                wire:loading.attr="disabled"
                class="inline-flex absolute top-5 right-5 justify-center items-center w-6 h-6 text-xs opacity-60 font-bold text-white bg-gray-700 rounded-full cursor-pointer"
                    wire:click.prevent="{{ $attributes->get('remove') }}">
                    <i class="las la-times leading-none"></i>
                </button>
                <div>
                    <img src="{{ htmlspecialchars_decode($attributes->get('temporaryUrl')) }}" 
                        class="object-cover rounded border border-gray-200" 
                        style="width: 100%;">
                </div>
            @else
                <div>
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="file-upload"
                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="{{ $attributes->get('name') }}" type="file"
                                wire:model.defer="{{ $attributes->get('model') }}" class="sr-only" accept="image/*">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                </div>  
            @endif

              
            <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP up to 3MB</p>
        </div>
    </div>
    @error($attributes->get('name'))
        <x-validation-message>
            {{ $message }}
        </x-validation-message>
    @enderror
</div>