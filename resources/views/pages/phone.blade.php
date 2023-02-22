<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100 leading-tight">
            {{ __('Phone') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-12">
                    <div class="col-span-1 md:col-span-3">
                        @livewire('component-menu', ['patient' => $patient])
                    </div>

                    <div class="col-span-1 md:col-span-9">
                        @livewire('component-phone', ['patient' => $patient])
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>