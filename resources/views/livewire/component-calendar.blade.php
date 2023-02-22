<div class="p-4 grid grid-cols-1 md:grid-cols-12 bg-gray-200 dark:bg-gray-800 m-2 gap-2 rounded-xl">
    <div class="col-span-1 md:col-span-6">
        <x-label>
            {{ __('Patient') }}
        </x-label>

        <x-select wire:model='patient_id'>
            @slot('content')
                <option value="null">{{ __('Select an option') }}</option>
                @foreach ($patients as $patient)
                    <option value="{{ $patient->id }}">{{ $patient->name }} {{ $patient->lastname }}</option>
                @endforeach
            @endslot
        </x-select>

        <x-input-error for="patient_id" />
    </div>

    <div class="col-span-1 md:col-span-12 text-gray-900 dark:text-gray-500 mt-2" wire:ignore>
        <div id='calendar' data="{{ $meetings }}"></div>
    </div>
</div>