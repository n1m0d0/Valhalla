<div class="p-2">
    <x-list>
        @slot('search')
            <div class="col-span-1 md:col-span-12">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" wire:model="search"
                        class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @if ($search != null)
                        <a wire:click='resetSearch'
                            class="text-white absolute right-2.5 bottom-2.5 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 cursor-pointer">
                            X
                        </a>
                    @endif
                </div>
            </div>
        @endslot

        @slot('options')
        @endslot

        @slot('table')
            <x-table>
                @slot('head')
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('Photo') }}
                        </th>

                        <th scope="col" class="px-6 py-3">
                            {{ __('Name') }}
                        </th>

                        <th scope="col" class="px-6 py-3">
                            {{ __('Title') }}
                        </th>

                        <th scope="col" class="px-6 py-3">
                            {{ __('Start') }}
                        </th>

                        <th scope="col" class="px-6 py-3">
                            {{ __('End') }}
                        </th>

                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Options</span>
                        </th>
                    </tr>
                @endslot

                @slot('body')
                    @foreach ($meetings as $meeting)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                @if ($meeting->patient->photo_path != null)
                                    <img src="{{ Storage::url($meeting->patient->photo_path) }}"
                                        class="rounded-full h-16 w-16 object-cover" data-action="zoom">
                                @else
                                    <x-feathericon-user class="h-16 w-16 text-gray-700 dark:text-white" />
                                @endif
                            </td>

                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $meeting->patient->name }} {{ $meeting->patient->last_name }}
                            </th>

                            <td class="px-6 py-4">
                                {{ $meeting->title }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $meeting->start }}
                            </td>

                            <td class="px-6 py-4">
                                {{ $meeting->end }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-left">
                                <ul>
                                    <li>
                                        <a wire:click='modalDiagnostic({{ $meeting->id }})'
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">
                                            {{ __('Diagnostic') }}
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                @endslot
            </x-table>
        @endslot

        @slot('paginate')
            {{ $meetings->links('vendor.livewire.custom') }}
        @endslot
    </x-list>

    <x-dialog-modal wire:model="diagnosticModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-blue-500 mr-2" />

                {{ __('Diagnostic') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-btn-red wire:click="$set('diagnosticModal', false)" wire:loading.attr="disabled" class="w-1/3">
                {{ __('Cancel') }}
            </x-btn-red>

            <x-btn-blue class="ml-2" wire:click='diagnostic' wire:loading.attr="disabled" class="w-1/3">
                {{ __('Accept') }}
            </x-btn-blue>
        </x-slot>
    </x-dialog-modal>
</div>
