<button type="{{ $attributes->get('type','button') }}" class="{{ $attributes->merge(['class' => 'inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500'])->get('class') }}">
    {{ $attributes->get('label')??$slot }}
</button>