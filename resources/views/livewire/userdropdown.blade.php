<div>
    <div class="flex relative justify-between items-center">
        <div class="lg:flex lg:items-center lg:justify-between">
            <div class="min-w-0 flex-1">
                <nav aria-label="breadcrumb" class="w-max">
                    <ol class="flex w-full flex-wrap items-center rounded-md bg-blue-gray-50 py-1 bg-opacity-60 ">
                        <li
                            class="flex cursor-pointer items-center font-sans text-sm font-normal leading-normal text-white antialiased hover:text-yellow-200 duration-300 ">
                            <a class="opacity-60" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </a>
                            <span
                                class="pointer-events-none mx-2 select-none font-sans text-sm font-normal leading-normal text-blue-gray-500 antialiased">
                                -
                            </span>
                        </li>
                        <li
                            class="flex cursor-pointer items-center font-sans text-sm  leading-normal text-white antialiased transition-colors duration-300 ">
                            <a class="" href="#">
                                <span class="uppercase">{{ auth()->user()->name }}</span>
                            </a>

                        </li>

                    </ol>
                </nav>
                <h2
                    class="text-xl font-semibold leading-7 uppercase text-white sm:truncate sm:text-xl sm:tracking-tight">
                    @yield('title')
                </h2>
            </div>

        </div>

        <div x-data="{
            dropdownOpen: false
        }" class="relative">

            <button @click="dropdownOpen=true"
                class="inline-flex items-center justify-center h-12 py-2 pl-3 pr-12 text-sm font-medium transition-colors bg-white border rounded-md text-neutral-700 hover:bg-neutral-100 active:bg-white focus:bg-white focus:outline-none disabled:opacity-50 disabled:pointer-events-none">

                <span class="flex flex-col items-start flex-shrink-0 h-full ml-2 leading-none translate-y-px">
                    <span>{{ auth()->user()->name }}</span>
                    <span class="text-xs font-light text-neutral-400">{{ ucfirst(auth()->user()->user_type) }}</span>
                </span>
                <svg class="absolute right-0 w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                </svg>
            </button>

            <div x-show="dropdownOpen" @click.away="dropdownOpen=false" x-transition:enter="ease-out duration-200"
                x-transition:enter-start="-translate-y-2" x-transition:enter-end="translate-y-0"
                class="absolute top-0 z-50 w-56 mt-12 -translate-x-1/2 left-1/2" x-cloak>
                <div class="p-1 mt-1 bg-white border rounded-md shadow-md border-neutral-200/70 text-neutral-700">
                    <div class="px-2 py-1.5 text-sm font-semibold">My Account</div>
                    <div class="h-px my-1 -mx-1 bg-neutral-200"></div>
                    <a href="#_"
                        class="relative flex cursor-default select-none hover:bg-neutral-100 items-center rounded px-2 py-1.5 text-sm outline-none transition-colors data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="w-4 h-4 mr-2">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Profile</span>
                        <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘P</span>
                    </a>

                    <div class="h-px my-1 -mx-1 bg-neutral-200"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="route('logout')"
                            onclick="event.preventDefault();
                                    this.closest('form').submit();"
                            class="relative flex cursor-pointer select-none hover:bg-neutral-100 hover:text-red-600 items-center rounded px-2 py-1.5 text-sm outline-none transition-colors focus:bg-accent focus:text-accent-foreground data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-4 h-4 mr-2">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" x2="9" y1="12" y2="12"></line>
                            </svg>
                            <span>Log out</span>
                            <span class="ml-auto text-xs tracking-widest opacity-60">⇧⌘Q</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
