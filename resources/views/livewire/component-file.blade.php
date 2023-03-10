<div class="p-2 grid grid-cols-1 md:grid-cols-12 gap-2">
    <div class="col-span-1 md:col-span-3 flex items-center justify-center border-gray-600 border-2 rounded-xl p-2">
        <img src="{{ Storage::url($patient->photo_path) }}" class="rounded-2xl h-36 w-36 object-cover">
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

        <ul class="space-y-4 text-gray-800 list-disc list-inside dark:text-white m-2">
            @foreach ($patient->record->details as $detail)
                <li>
                    {{ $detail->question->description }}

                    <ol class="pl-5 mt-2 text-gray-600 dark:text-gray-400 space-y-1 list-inside">
                        <li>
                            {{ $detail->description }}
                        </li>
                    </ol>
                </li>
            @endforeach
        </ul>
    </div>
</div>
