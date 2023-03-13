<div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4 m-4">
    <ul class="space-y-2">
        <li>
            @role('Admin|Doctor|Secretary')
                <x-item-menu href="{{ route('page.file', $patient) }}">
                    {{ __('File') }}
                </x-item-menu>

                <x-item-menu href="{{ route('page.address', $patient) }}">
                    {{ __('Address') }}
                </x-item-menu>

                <x-item-menu href="{{ route('page.phone', $patient) }}">
                    {{ __('Phone') }}
                </x-item-menu>
            @endrole

            @role('Admin|Doctor')
                <x-item-menu href="{{ route('page.detail', $patient) }}">
                    {{ __('History') }}
                </x-item-menu>
            @endrole

            @role('Admin|Doctor|Secretary')

                <x-item-menu href="{{ route('page.meeting', $patient) }}">
                    {{ __('Meeting') }}
                </x-item-menu>
            @endrole

            @role('Admin|Doctor')
                <x-item-menu href="{{ route('page.diagnostic', $patient) }}">
                    {{ __('Diagnostic') }}
                </x-item-menu>
            @endrole
        </li>
    </ul>
</div>
