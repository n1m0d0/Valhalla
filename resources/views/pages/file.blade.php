<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('File') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('component-file', ['patient' => $patient])
            </div>
        </div>
    </div>
</x-app-layout>