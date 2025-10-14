<!-- Backdrop -->
<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
</div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a href="{{ route('admin.dashboard') }}">
            <img class="ml-6" src="{{asset('/assets/images/logo.png')}}" width="90px" alt="IMG-LOGO">
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                @if (request()->is('admin'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif

                <a class="
                    {{ request()->is('admin') ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100' : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' }}
                     " href="{{ route('admin.dashboard') }}">
                    <svg height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                        <path
                            d="M520-600v-240h320v240H520ZM120-440v-400h320v400H120Zm400 320v-400h320v400H520Zm-400 0v-240h320v240H120Zm80-400h160v-240H200v240Zm400 320h160v-240H600v240Zm0-480h160v-80H600v80ZM200-200h160v-80H200v80Zm160-320Zm240-160Zm0 240ZM360-280Z" />
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>

        <ul>
            <li class="relative px-6 py-3">
                @if (request()->is('admin/categories'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="{{ request()->is('admin/categories') ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100' : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' }}
                     " href="{{ route('admin.categories') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="m2.53 19.65 1.34.56v-9.03l-2.43 5.86c-.41 1.02.08 2.19 1.09 2.61m19.5-3.7L17.07 3.98c-.31-.75-1.04-1.21-1.81-1.23-.26 0-.53.04-.79.15L7.1 5.95c-.75.31-1.21 1.03-1.23 1.8-.01.27.04.54.15.8l4.96 11.97c.31.76 1.05 1.22 1.83 1.23.26 0 .52-.05.77-.15l7.36-3.05c1.02-.42 1.51-1.59 1.09-2.6M7.88 8.75c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1m-2 11c0 1.1.9 2 2 2h1.45l-3.45-8.34z">
                        </path>
                    </svg>
                    <span class="ml-4">Categories</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->is('admin/sizes'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="{{ request()->is('admin/sizes') ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100' : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' }}
                     " href="{{ route('admin.sizes') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="m12 2-5.5 9h11z"></path>
                        <circle cx="17.5" cy="17.5" r="4.5"></circle>
                        <path d="M3 13.5h8v8H3z"></path>
                    </svg>
                    <span class="ml-4">Sizes</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (
                        request()->is('admin/food') || request()->is('admin/food/add') ||
                        request()->is('admin/reviews')
                    )
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <button
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    @click="togglePagesMenu" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="currentColor">
                            <path
                                d="M160-120q-33 0-56.5-23.5T80-200v-120h800v120q0 33-23.5 56.5T800-120H160Zm0-120v40h640v-40H160Zm320-180q-36 0-57 20t-77 20q-56 0-76-20t-56-20q-36 0-57 20t-77 20v-80q36 0 57-20t77-20q56 0 76 20t56 20q36 0 57-20t77-20q56 0 77 20t57 20q36 0 56-20t76-20q56 0 79 20t55 20v80q-56 0-75-20t-55-20q-36 0-58 20t-78 20q-56 0-77-20t-57-20ZM80-560v-40q0-115 108.5-177.5T480-840q183 0 291.5 62.5T880-600v40H80Zm400-200q-124 0-207.5 31T166-640h628q-23-58-106.5-89T480-760Zm0 520Zm0-400Z" />
                        </svg>
                        <span class="ml-4">Food</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isPagesMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="{{ request()->is('admin/food') ? 'px-2 py-1 transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200' : 'px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'}}  
                                ">
                            <a class="w-full" href="{{ route('admin.food') }}">All Food</a>
                        </li>
                        <li class="{{ request()->is('admin/food/add') ? 'px-2 py-1 transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200' : 'px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'}}  
                                ">
                            <a class="w-full" href="{{ route('admin.food.add') }}">
                                Add Food
                            </a>
                        </li>
                        <li class="{{ request()->is('admin/reviews') ? 'px-2 py-1 transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200' : 'px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'}}  
                                ">
                            <a class="w-full" href="{{ route('admin.reviews') }}">
                                Food Reviews
                            </a>
                        </li>
                    </ul>
                </template>
            </li>

            <li class="relative px-6 py-3">
                @if (request()->is('admin/orders'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="{{ request()->is('admin/orders') ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100' : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' }}
                     " href="{{ route('admin.orders') }}">
                    <svg height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                        <path
                            d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z" />
                    </svg>
                    <span class="ml-4">Orders</span>
                </a>
            </li>

            <li class="relative px-6 py-3">
                @if (request()->is('admin/customers'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="{{ request()->is('admin/customers') ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100' : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' }}
                     " href="{{ route('admin.customers') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3m-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3m0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5m8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5">
                        </path>
                    </svg>
                    <span class="ml-4">Customers</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->is('admin/customers'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="{{ request()->is('admin/bookings') ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100' : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' }}
                     " href="{{ route('admin.bookings') }}">
                    <svg height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                        <path
                            d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z" />
                    </svg>
                    <span class="ml-4">Bookings</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->is('admin/counties'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="{{ request()->is('admin/counties') ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100' : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' }}
                     " href="{{ route('admin.counties') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M12 2C8.13 2 5 5.13 5 9c0 1.74.5 3.37 1.41 4.84.95 1.54 2.2 2.86 3.16 4.4.47.75.81 1.45 1.17 2.26.26.55.47 1.5 1.26 1.5s1-.95 1.25-1.5c.37-.81.7-1.51 1.17-2.26.96-1.53 2.21-2.85 3.16-4.4C18.5 12.37 19 10.74 19 9c0-3.87-3.13-7-7-7m0 9.75c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5">
                        </path>
                    </svg>
                    <span class="ml-4">Counties</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (request()->is('admin/rates') || request()->is('admin/rates/add'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <button
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    @click="toggleCouponsMenu" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <svg height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                            <path
                                d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H182l4-17q6-28 27.5-45.5T264-800h456l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-19-273 2-7-84 360 2-7 34-146 46-200ZM20-427l20-80h220l-20 80H20Zm80-146 20-80h260l-20 80H100Zm180 333q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z" />
                        </svg>
                        <span class="ml-4">Shipping Rates</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isCouponsMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="{{ request()->is('admin/rates') ? 'px-2 py-1 transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200' : 'px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'}}  
                                ">
                            <a class="w-full" href="{{ route('admin.rates') }}">All Shipping Rates</a>
                        </li>
                        <li class="{{ request()->is('admin/rates/add') ? 'px-2 py-1 transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200' : 'px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'}}  
                                ">
                            <a class="w-full" href="{{ route('admin.rates.add') }}">
                                Add Shipping Rates
                            </a>
                        </li>
                    </ul>
                </template>
            </li>

            <li class="relative px-6 py-3">
                @if (request()->is('admin/coupons'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="{{ request()->is('admin/coupons') ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100' : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' }}
                                 " href="{{ route('admin.coupons') }}">
                    <svg height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                        <path
                            d="M160-280v80h640v-80H160Zm0-440h88q-5-9-6.5-19t-1.5-21q0-50 35-85t85-35q30 0 55.5 15.5T460-826l20 26 20-26q18-24 44-39t56-15q50 0 85 35t35 85q0 11-1.5 21t-6.5 19h88q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720Zm0 320h640v-240H596l84 114-64 46-136-184-136 184-64-46 82-114H160v240Zm200-320q17 0 28.5-11.5T400-760q0-17-11.5-28.5T360-800q-17 0-28.5 11.5T320-760q0 17 11.5 28.5T360-720Zm240 0q17 0 28.5-11.5T640-760q0-17-11.5-28.5T600-800q-17 0-28.5 11.5T560-760q0 17 11.5 28.5T600-720Z" />
                    </svg>
                    <span class="ml-4">Coupons</span>
                </a>
            </li>
            <li class="relative px-6 py-3">
                @if (
                        request()->is('admin/equipments') || request()->is('admin/equipment/add')
                    )
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <button
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    @click="toggleSettingsMenu" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <svg height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                            <path
                                d="M744-80 511-312l-28 28q-23 23-52.5 35T370-237q-31 0-61-12t-53-35L87-454q-23-23-35-52.5T40-567q0-31 12-60.5T87-680l113-113q23-23 52.5-35t60.5-12q31 0 60.5 12t52.5 35l170 169q23 23 35 53t12 61q0 31-12 60.5T596-397l-28 28 232 233-56 56ZM370-317q15 0 29.5-5.5T426-340l114-114q12-11 17.5-26t5.5-30q0-15-5.5-30T540-567L370-736q-11-12-26-18t-30-6q-15 0-30 6t-27 18L144-623q-12 12-17.5 26.5T121-567q0 15 5.5 30t17.5 27l170 170q11 12 26 17.5t30 5.5ZM207-516q13 0 21.5-8.5T237-546q0-13-8.5-21.5T207-576q-13 0-21.5 8.5T177-546q0 13 8.5 21.5T207-516Zm64-63q13 0 21.5-8.5T301-609q0-13-8.5-21.5T271-639q-13 0-21.5 8.5T241-609q0 13 8.5 21.5T271-579Zm7 134q13 0 21.5-8.5T308-475q0-13-8.5-21.5T278-505q-13 0-21.5 8.5T248-475q0 13 8.5 21.5T278-445Zm56-198q13 0 21.5-8.5T364-673q0-13-8.5-21.5T334-703q-13 0-21.5 8.5T304-673q0 13 8.5 21.5T334-643Zm8 135q13 0 21.5-8.5T372-538q0-13-8.5-21.5T342-568q-13 0-21.5 8.5T312-538q0 13 8.5 21.5T342-508Zm6 134q13 0 21.5-8.5T378-404q0-13-8.5-21.5T348-434q-13 0-21.5 8.5T318-404q0 13 8.5 21.5T348-374Zm57-198q13 0 21.5-8.5T435-602q0-13-8.5-21.5T405-632q-13 0-21.5 8.5T375-602q0 13 8.5 21.5T405-572Zm7 134q13 0 21.5-8.5T442-468q0-13-8.5-21.5T412-498q-13 0-21.5 8.5T382-468q0 13 8.5 21.5T412-438Zm64-64q13 0 21.5-8.5T506-532q0-13-8.5-21.5T476-562q-13 0-21.5 8.5T446-532q0 13 8.5 21.5T476-502Zm304-98q-58 0-99-41t-41-99q0-58 41-99t99-41q58 0 99 41t41 99q0 58-41 99t-99 41Zm0-80q25 0 42.5-17.5T840-740q0-25-17.5-42.5T780-800q-25 0-42.5 17.5T720-740q0 25 17.5 42.5T780-680ZM342-538Zm438-202Z" />
                        </svg>
                        <span class="ml-4">Equipments</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isSettingsMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="{{ request()->is('admin/equipments') ? 'px-2 py-1 transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200' : 'px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'}}  
                            ">
                            <a class="w-full" href="{{ route('admin.equipments') }}">All Equipments</a>
                        </li>
                        <li class="{{ request()->is('admin/equipment/add') ? 'px-2 py-1 transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200' : 'px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'}}  
                            ">
                            <a class="w-full" href="{{ route('admin.equipment.add') }}">
                                Add Equipment
                            </a>
                        </li>
                    </ul>
                </template>
            </li>
            <li class="relative px-6 py-3">
                @if (
                        request()->is('admin/galleries') || request()->is('admin/gallery/add')
                    )
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <button
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    @click="toggleEmailsMenu" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <svg height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                            <path
                                d="M120-200q-33 0-56.5-23.5T40-280v-400q0-33 23.5-56.5T120-760h400q33 0 56.5 23.5T600-680v400q0 33-23.5 56.5T520-200H120Zm600-320q-17 0-28.5-11.5T680-560v-160q0-17 11.5-28.5T720-760h160q17 0 28.5 11.5T920-720v160q0 17-11.5 28.5T880-520H720Zm40-80h80v-80h-80v80ZM120-280h400v-400H120v400Zm40-80h320L375-500l-75 100-55-73-85 113Zm560 160q-17 0-28.5-11.5T680-240v-160q0-17 11.5-28.5T720-440h160q17 0 28.5 11.5T920-400v160q0 17-11.5 28.5T880-200H720Zm40-80h80v-80h-80v80Zm-640 0v-400 400Zm640-320v-80 80Zm0 320v-80 80Z" />
                        </svg>
                        <span class="ml-4">Gallery</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isEmailsMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li class="{{ request()->is('admin/galleries') ? 'px-2 py-1 transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200' : 'px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'}}  
                            ">
                            <a class="w-full" href="{{ route('admin.galleries') }}">All Event</a>
                        </li>
                        <li class="{{ request()->is('admin/gallery/add') ? 'px-2 py-1 transition-colors duration-150 text-gray-800 dark:text-gray-100 hover:text-gray-800 dark:hover:text-gray-200' : 'px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200'}}  
                            ">
                            <a class="w-full" href="{{ route('admin.gallery.add') }}">
                                Add Event
                            </a>
                        </li>
                    </ul>
                </template>
            </li>


            <li class="relative px-6 py-3">
                @if (request()->is('admin/settings'))
                    <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                        aria-hidden="true"></span>
                @endif
                <a class="{{ request()->is('admin/settings') ? 'inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100' : 'inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200' }}
                                 " href="{{ route('admin.settings') }}">
                    <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path
                            d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58c.18-.14.23-.41.12-.61l-1.92-3.32c-.12-.22-.37-.29-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54c-.04-.24-.24-.41-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.09.63-.09.94s.02.64.07.94l-2.03 1.58c-.18.14-.23.41-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61zM12 15.6c-1.98 0-3.6-1.62-3.6-3.6s1.62-3.6 3.6-3.6 3.6 1.62 3.6 3.6-1.62 3.6-3.6 3.6">
                        </path>
                    </svg>
                    <span class="ml-4">Settings</span>
                </a>
            </li>
        </ul>
        <div class="px-6 my-6">
            <a href="{{ route('admin.profile') }}">
                <button
                    class="flex items-center justify-between w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Profile
                    <span class="ml-2" aria-hidden="true">+</span>
                </button>
            </a>
        </div>
    </div>
</aside>