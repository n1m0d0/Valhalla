<div class="p-4 grid grid-cols-1 md:grid-cols-12 bg-gray-200 dark:bg-gray-800 m-2 gap-2 rounded-xl">
    <div class="col-span-1 md:col-span-3 grid grid-cols-1 md:grid-cols-12 gap-2">
        <x-menu />
    </div>
    <div class="col-span-1 md:col-span-9 grid grid-cols-1 md:grid-cols-12 gap-2">
        {{ $body }}
    </div>
</div>