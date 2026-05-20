<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                        Master Customer
                    </h3>

                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        Access master customers.
                    </p>

                    <a href="/register-chat"
                        class="mt-4 inline-block px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                        Start Chat
                    </a>

                </div>

                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">

                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                        Service Desk Workspace
                    </h3>

                    <p class="text-gray-600 dark:text-gray-300 mt-2">
                        Manage incoming customer sessions.
                    </p>

                    <a href="/workspace"
                        class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Open Workspace
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
