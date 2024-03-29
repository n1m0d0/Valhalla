<div class="grid grid-cols-1 md:grid-cols-12 gap-2">
    <div class="col-span-1 md:col-span-4 p-2">
        <div
            class="w-full max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">
                    {{ __('Record') }}
                </h5>
            </div>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <x-feathericon-book-open class="h-8 w-8 text-gray-500 mr-2" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ __('User') }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ __('Registered users.') }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $users->count() }}
                            </div>
                        </div>
                    </li>
                </ul>

                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <x-feathericon-book-open class="h-8 w-8 text-gray-500 mr-2" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ __('Patient') }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ __('Registered patients.') }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $patients->count() }}
                            </div>
                        </div>
                    </li>
                </ul>

                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <x-feathericon-book-open class="h-8 w-8 text-gray-500 mr-2" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ __('Meeting') }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ __('Registered meetings.') }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ $meetings->count() }}
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-span-1 md:col-span-8 grid grid-cols-1 md:grid-cols-12 p-2 gap-2 items-center">
        <div class="border border-gray-200 dark:border-gray-700 rounded-lg shadow col-span-1 md:col-span-6 bg-white dark:bg-gray-800 h-64">
            
        </div>

        <div class="border border-gray-200 dark:border-gray-700 rounded-lg shadow col-span-1 md:col-span-6 bg-white dark:bg-gray-800 h-64">
            
        </div>
    </div>
</div>
