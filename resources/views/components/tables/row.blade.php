<tr {{ $attributes->merge(['class' => 'border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700']) }}>
    {{ $slot }}
</tr>
