<a
    {{ $attributes->merge([
        'class' =>
            'flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer',
    ]) }}>
    <x-feathericon-arrow-right class="h-6 w-6 text-gray-500 mr-2" />
    <span class="ml-3">{{ $slot }}</span>
</a>
