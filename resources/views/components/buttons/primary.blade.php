<button type="{{ $attributes->get('type','button') }}" class="{{ $attributes->merge(['class' => 'inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'])->get('class') }}">
    {{ $attributes->get('label')??$slot }}
</button>