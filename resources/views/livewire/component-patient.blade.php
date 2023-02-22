<div class="p-2">
    <x-form-patient>
        @slot('photo')
            @if ($activity == 'create')
                <div class="text-center">
                    @if ($photo_path)
                        <x-label>
                            {{ __('Preview') }}
                        </x-label>
                        <img src="{{ $photo_path->temporaryUrl() }}" class="rounded-2xl h-36 w-36 object-cover"
                            data-action="zoom">
                    @endif
                </div>
            @endif

            @if ($activity == 'edit')
                <div class="text-center">
                    <x-label>
                        {{ __('Previous image') }}
                    </x-label>

                    <img src="{{ Storage::url($photo_path_Before) }}" class="rounded-2xl h-36 w-36 object-cover"
                        data-action="zoom">
                </div>

                <div class="text-center">
                    @if ($photo_path)
                        <x-label>
                            {{ __('New image') }}
                        </x-label>
                        <img src="{{ $photo_path->temporaryUrl() }}" class="rounded-2xl h-36 w-36 object-cover"
                            data-action="zoom">
                    @endif
                </div>
            @endif
        @endslot

        @slot('form')
            <div class="col-span-1 md:col-span-6">
                <x-label>
                    {{ __('Name') }}
                </x-label>

                <x-input type="text" wire:model='name' />

                <x-input-error for="name" />
            </div>

            <div class="col-span-1 md:col-span-6">
                <x-label>
                    {{ __('Lastname') }}
                </x-label>

                <x-input type="text" wire:model='lastname' />

                <x-input-error for="lastname" />
            </div>

            <div class="col-span-1 md:col-span-6">
                <x-label>
                    {{ __('Identity Card') }}
                </x-label>

                <x-input type="text" wire:model='identity_card' />

                <x-input-error for="identity_card" />
            </div>

            <div class="col-span-1 md:col-span-6">
                <x-label>
                    {{ __('Issued') }}
                </x-label>

                <x-select wire:model='issued'>
                    @slot('content')
                        <option value="null">{{ __('Select an option') }}</option>
                        <option value="CH">Chuquisaca</option>
                        <option value="LP">La Paz</option>
                        <option value="CB">Cochabamba</option>
                        <option value="OR">Oruro</option>
                        <option value="PT">Potosí</option>
                        <option value="TJ">Tarija</option>
                        <option value="SC">Santa Cruz</option>
                        <option value="BE">Beni</option>
                        <option value="PD">Pando</option>
                    @endslot
                </x-select>

                <x-input-error for="issued" />
            </div>

            <div class="col-span-1 md:col-span-6">
                <x-label>
                    {{ __('Birthdate') }}
                </x-label>

                <x-input type="date" wire:model='birthdate' />

                <x-input-error for="birthdate" />
            </div>

            <div class="col-span-1 md:col-span-6">
                <x-label>
                    {{ __('Sex') }}
                </x-label>

                <x-select wire:model='sex'>
                    @slot('content')
                        <option value="null">{{ __('Select an option') }}</option>
                        <option value="1">{{ __('Male') }}</option>
                        <option value="2">{{ __('Female') }}</option>
                    @endslot
                </x-select>

                <x-input-error for="sex" />
            </div>

            <div class="col-span-1 md:col-span-12">
                <x-label>
                    {{ __('Photo') }}
                </x-label>

                <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                    <!-- File Input -->
                    <x-input type='file' id="upload{{ $iteration }}" wire:model='photo_path' />

                    <!-- Progress Bar -->
                    <div x-show="isUploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>

                <x-input-error for="photo_path" />
            </div>
        @endslot

        @slot('buttons')
            @if ($activity == 'create')
                <x-btn-blue wire:click='store' wire:loading.attr="disabled" wire:target="store" class="w-full md:w-1/4">
                    {{ __('Save') }}
                </x-btn-blue>
            @endif

            @if ($activity == 'edit')
                <x-btn-green wire:click='update' wire:loading.attr="disabled" wire:target="store" class="w-full md:w-1/4">
                    {{ __('Update') }}
                </x-btn-green>
            @endif
            <x-btn-red wire:click='clear' wire:loading.attr="disabled" wire:target="store" class="w-full md:w-1/4">
                {{ __('Cancel') }}
            </x-btn-red>
        @endslot
    </x-form-patient>

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
                            {{ __('Sex') }}
                        </th>

                        <th scope="col" class="px-6 py-3">
                            {{ __('Identity Card') }}
                        </th>

                        <th scope="col" class="px-6 py-3">
                            {{ __('Birthdate') }}
                        </th>

                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Options</span>
                        </th>
                    </tr>
                @endslot

                @slot('body')
                    @foreach ($patients as $patient)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                <img src="{{ Storage::url($patient->photo_path) }}"
                                    class="rounded-full h-16 w-16 object-cover" data-action="zoom">
                            </td>

                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $patient->name }} {{ $patient->lastname }}
                            </th>

                            <td class="px-6 py-4">
                                @if ($patient->sex == 1)
                                    {{ __('Male') }}
                                @endif

                                @if ($patient->sex == 2)
                                    {{ __('Female') }}
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                {{ $patient->identity_card }} {{ $patient->issued }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $patient->birthdate }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-left">
                                <ul>
                                    <li>
                                        <a href="{{ route('page.address', $patient) }}"
                                            class="font-medium text-orange-600 dark:text-orange-500 hover:underline cursor-pointer">
                                            {{ __('File') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a wire:click='edit({{ $patient->id }})'
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline cursor-pointer">
                                            {{ __('Edit') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a wire:click='modalDelete({{ $patient->id }})'
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline cursor-pointer">
                                            {{ __('Delete') }}
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
            {{ $patients->links('vendor.livewire.custom') }}
        @endslot
    </x-list>

    <x-dialog-modal wire:model="deleteModal">
        <x-slot name="title">
            <div class="flex col-span-6 sm:col-span-4 items-center">
                <x-feathericon-alert-triangle class="h-10 w-10 text-red-500 mr-2" />

                {{ __('Delete') }}
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex col-span-6 sm:col-span-4 items-center gap-2">
                <x-feathericon-trash class="h-20 w-20 text-red-500 mr-2" />

                <p>
                    {{ __('Once deleted, the record cannot be recovered.') }}
                </p>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-btn-red wire:click="$set('deleteModal', false)" wire:loading.attr="disabled" class="w-1/3">
                {{ __('Cancel') }}
            </x-btn-red>

            <x-btn-blue class="ml-2" wire:click='delete' wire:loading.attr="disabled" class="w-1/3">
                {{ __('Accept') }}
            </x-btn-blue>
        </x-slot>
    </x-dialog-modal>
</div>
