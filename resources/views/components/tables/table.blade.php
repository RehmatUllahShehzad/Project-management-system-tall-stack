<div class="{{ $attributes->merge(['class' => 'relative overflow-x-auto shadow-md sm:rounded-lg'])->get('class') }}">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <x-tables.header>
            {{ $header ?? '' }}
        </x-tables.header>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
