<div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4 m-4">
    <ul class="space-y-2">
        <li>
            <x-item-menu href="{{ route('page.file', $patient) }}">
                {{ __('File') }}
            </x-item-menu>

            <x-item-menu href="{{ route('page.address', $patient) }}">
                {{ __('Address') }}
            </x-item-menu>

            <x-item-menu href="{{ route('page.phone', $patient) }}">
                {{ __('Phone') }}
            </x-item-menu>

            <x-item-menu href="{{ route('page.meeting', $patient) }}">
                {{ __('Meeting') }}
            </x-item-menu>
        </li>
    </ul>
</div>