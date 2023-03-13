<div class="p-2 grid grid-cols-1 md:grid-cols-12 gap-2">
    <div class="col-span-1 md:col-span-3 flex items-center justify-center border-gray-600 border-2 rounded-xl p-2">
        @if ($patient->photo_path != null)
            <img src="{{ Storage::url($patient->photo_path) }}" class="rounded-full h-36 w-36 object-cover"
                data-action="zoom">
        @else
            <x-feathericon-user class="h-36 w-36 text-gray-700 dark:text-white" />
        @endif
    </div>

    <div class="col-span-1 md:col-span-9 border-gray-600 border-2 rounded-xl p-2">
        <h1 class="text-gray-800 dark:text-white text-2xl text-left">
            {{ $patient->name }} {{ $patient->last_name }}
        </h1>

        <h1 class="text-gray-800 dark:text-white text-xl text-left">
            {{ __('Birthdate') }}:

            <span class="text-lg text-gray-700 dark:text-gray-400">
                {{ $patient->birthdate }}
            </span>
        </h1>

        <h1 class="text-gray-800 dark:text-white text-xl text-left">
            {{ __('Age') }}:

            <span class="text-lg text-gray-700 dark:text-gray-400">
                {{ $age }}
            </span>
        </h1>

        <h1 class="text-gray-800 dark:text-white text-xl text-left">
            {{ __('Identity Card') }}:

            <span class="text-lg text-gray-700 dark:text-gray-400">
                {{ $patient->identity_card }} {{ $patient->issued }}
            </span>
        </h1>

        <h1 class="text-gray-800 dark:text-white text-xl text-left">
            {{ __('Sex') }}:

            <span class="text-lg text-gray-700 dark:text-gray-400">
                @if ($patient->sex == 1)
                    {{ __('Male') }}
                @endif

                @if ($patient->sex == 2)
                    {{ __('Female') }}
                @endif
            </span>
        </h1>
    </div>

    <div class="col-span-1 md:col-span-6 border-gray-600 border-2 rounded-xl p-2">
        <h1 class="text-gray-800 dark:text-white text-xl text-left">
            {{ __('Addresses') }}:
        </h1>

        <ul>
            @foreach ($patient->addresses as $address)
                <li>
                    <p class="text-gray-800 dark:text-white text-xl text-left">
                        {{ __('Ubication') }}:

                        <span class="text-lg text-gray-700 dark:text-gray-400">
                            {{ $address->ubication }}
                        </span>
                    </p>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-span-1 md:col-span-6 border-gray-600 border-2 rounded-xl p-2">
        <h1 class="text-gray-800 dark:text-white text-xl text-left">
            {{ __('Phones') }}:
        </h1>

        <ul>
            @foreach ($patient->phones as $phone)
                <li>
                    <p class="text-gray-800 dark:text-white text-xl text-left">
                        {{ __('Number') }}:

                        <span class="text-lg text-gray-700 dark:text-gray-400">
                            {{ $phone->number }}
                        </span>
                    </p>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="col-span-1 md:col-span-12 border-gray-600 border-2 rounded-xl p-2">
        <h1 class="text-gray-800 dark:text-white text-xl text-left">
            {{ __('History') }}
        </h1>

        <ul class="grid grid-cols-1 md:grid-cols-12 text-gray-800 list-disc list-inside dark:text-white m-2">
            @if ($patient->record != null)
                @foreach ($patient->record->details as $detail)
                    <li class="col-span-4">
                        {{ $detail->question->description }}

                        <ol class="pl-5 mt-2 text-gray-600 dark:text-gray-400 space-y-1 list-inside">
                            <li>
                                {{ $detail->description }}
                            </li>
                        </ol>
                    </li>
                @endforeach
            @else
            @endif
        </ul>
    </div>

    <div class="col-span-1 md:col-span-12 border-gray-600 border-2 rounded-xl p-2">
        <h1 class="text-gray-800 dark:text-white text-xl text-left">
            {{ __('Diagnostic') }}
        </h1>

        <div class="col-span-1 md:col-span-12 mt-2">
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
                <input type="date" wire:model="search"
                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if ($search != null)
                    <a wire:click='resetSearch'
                        class="text-white absolute right-2.5 bottom-2.5 bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800 cursor-pointer">
                        X
                    </a>
                @endif
            </div>
        </div>

        <ol class="relative border-l border-gray-200 dark:border-gray-700 m-5">
            @if ($diagnostics != null)
                @foreach ($diagnostics as $diagnostic)
                    <li class="mb-10 ml-6">
                        <span
                            class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                            <svg aria-hidden="true" class="w-3 h-3 text-blue-800 dark:text-blue-300" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </span>
                        <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $diagnostic->created_at }}
                        </h3>
                        <h2 class="block mb-2 text-base font-normal leading-none text-gray-400 dark:text-gray-500">
                            {{ __('Quadrant') }}: {{ $diagnostic->tooth->quadrant }} {{ __('Tooth') }} {{ __('Number') }}: {{ $diagnostic->tooth->number }}
                        </h2>
                        <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                            {{ $diagnostic->description }}
                        </p>
                    </li>
                @endforeach
            @endif
        </ol>
        
        {{ $diagnostics->links('vendor.livewire.custom') }}
    </div>
</h1>
