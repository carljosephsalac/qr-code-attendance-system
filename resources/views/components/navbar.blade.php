<nav
    class="fixed top-0 z-20 w-full bg-white border-b border-gray-200 shadow-md dark:bg-gray-900 start-0 dark:border-gray-600">
    <div class="flex flex-wrap items-center justify-between p-4 mx-auto max-w-screen-2xl">
        @can('modify-user')
            <a href="{{ route('users.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                    Users QR Code Generator
                </span>
            </a>
        @endcan
        @cannot('modify-user')
            <a href="{{ route('users.index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">
                    Users Page
                </span>
            </a>
        @endcannot


        <button data-collapse-toggle="navbar-dropdown" type="button"
            class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            aria-controls="navbar-dropdown" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <div class="flex items-center justify-center gap-10">
            @can('modify-user')
                <div class="flex space-x-3 md:space-x-0 rtl:space-x-reverse">
                    <button data-modal-target="add-modal" data-modal-toggle="add-modal" type="button" id="add-btn"
                        class="px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ">
                        Add User
                    </button>
                </div>
            @endcan


            @auth
                <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                    <ul
                        class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-800 dark:border-gray-700">

                        <li>
                            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
                                class="flex items-center justify-between w-full px-3 py-2 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto dark:text-white md:dark:hover:text-blue-500 dark:focus:text-white dark:border-gray-700 dark:hover:bg-gray-700 md:dark:hover:bg-transparent">
                                {{ Auth::user()->name }}
                                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 4 4 4-4" />
                                </svg></button>
                            <!-- Dropdown menu -->
                            <div id="dropdownNavbar"
                                class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">

                                <div class="py-1">
                                    <form action="{{ route('logout') }}" method="POST"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                        @csrf
                                        <button class="w-full" type="submit">Sign out</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>

@can('modify-user')
    <x-modal header="Add a user" modalId="add-modal">
        <form action="{{ route('users.store') }}" method="POST" class="flex flex-col gap-6">
            @csrf
            <x-input type="text" name="name" id="name" placeholder="Carl Salac" required>
                Name
            </x-input>
            <x-input type="email" name="email" id="email" placeholder="carl@gmail.com" required>
                Email
            </x-input>
            <x-input type="password" name="password" id="password" placeholder="••••••••" required>
                Password
            </x-input>
            <x-button-success type="submit" class="mt-3">Save</x-button-success>
        </form>
    </x-modal>
@endcan
