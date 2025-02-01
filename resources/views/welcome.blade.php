<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Leaflet CSS -->



    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

    <!-- Scripts -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <!-- Scripts -->
    @wireUiScripts
    @filamentStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">


    <!-- Navigation bar section -->
    <div class="justify-center w-full mx-auto border-b bg-base-50">
        <div x-data="{ open: false }"
            class="flex flex-col w-full mx-auto md:px-12 md:items-center md:justify-between md:flex-row px-8 py-2 lg:px-24 max-w-screen-xl relative">
            <div class="flex flex-row items-center justify-between text-black">
                <a class="text-md leading-normal hover:text-accent-500 font-medium flex items-center gap-2 text-base-900"
                    href="#_">
                    <img class="h-12 2xl:h-16" src="{{ asset('images/stylesynclogo.png') }}" alt="#_" />

                </a>
                <button
                    class="flex items-center justify-center transition-all duration-200 focus:ring-2 transition-shadow focus:outline-none text-base-500 bg-white hover:text-accent-500 ring-1 ring-base-200 focus:ring-accent-500 size-9 p-2 text-sm rounded-md md:hidden"
                    @click="open = !open">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-layout-grid size-3"
                        x-data="{ open: false }">
                        <!-- Paths for burger icon -->
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                        <!-- Paths for close icon (toggle icon) -->
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{ 'flex': open, 'hidden': !open }"
                class="flex-col items-center flex-grow hidden gap-3 p-4 px-5 md:px-0 md:pb-0 md:flex md:justify-center md:flex-row lg:p-0">

                <a href="{{ route('login') }}"
                    class="flex md:ml-auto items-center justify-center bg-main transition-all duration-200 focus:ring-2 transition-shadow focus:outline-none text-white bg-accent-600 hover:bg-accent-700 focus:ring-accent-500/50 h-9 px-4 py-2 text-sm font-medium rounded-md">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="flex items-center justify-center border border-main text-main transition-all duration-200 focus:ring-2  bg-accent-600 hover:bg-accent-700 focus:ring-accent-500/50 h-9 px-4 py-2 text-sm font-medium rounded-md">
                    Register
                </a>
            </nav>
        </div>
    </div>
    <!-- Main hero section with headline and call to action -->
    <section class="relative overflow-hidden">
        <div class="px-8 py-24 mx-auto md:px-12 lg:px-24 max-w-7xl relative">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-center">
                <div>

                    <h2
                        class="text-xl leading-tight tracking-tight sm:text-2xl md:text-3xl lg:text-4xl mt-4 font-semibold text-base-900">
                        Syncing You with the Best Barbershops
                    </h2>
                    <p class="text-base leading-normal mt-4 text-base-500 font-medium">
                        Effortlessly find the best
                        barbers near
                        you.
                    </p>

                </div>
                <div class="lg:col-span-2">
                    <img class="object-cover h-full border shadow rounded-2xl" src="{{ asset('images/bg1.jpg') }}"
                        alt="#_" />
                </div>
            </div>

        </div>
    </section>
    <!-- Feature section highlighting key benefits or services -->

    <!-- Testimonials section displaying customer feedback -->
    <section>
        <div class="2xl:px-5 px-2 rounded-3xl shadow-xl  mx-auto  max-w-7xl border relative">
            <livewire:map />
        </div>
    </section>
    <!-- Pricing section with available plans and details -->
    <section x-data="{ duration: 'monthly' }" class="bg-gray-100 mt-10">
        <div class="px-8 py-24 mx-auto md:px-12 lg:px-24 max-w-screen-xl relative">
            <div class="max-w-xl text-center mx-auto">
                <p class="text-sm leading-normal font-bold uppercase text-accent-600">
                    Tagline
                </p>
                <h2
                    class="text-xl leading-tight tracking-tight sm:text-2xl md:text-3xl lg:text-4xl mt-4 font-semibold text-base-900 lg:text-balance">
                    Equip your business with world class software
                </h2>
                <p class="text-base leading-normal mt-4 text-base-500 font-medium lg:text-balance">
                    Choose a plan that works the best for you and your team. Start small,
                    upgrade when you need to.
                </p>
                <div aria-labelledby="pricing-toggle"
                    class="w-full relative mt-8 ring-1 ring-base-200 ring-offset-2 bg-white overflow-hidden justify-center gap-4 mx-auto lg:mx-0 inline-flex p-1 rounded-md max-w-52 shadow z-0">
                    <!-- Monthly Pricing Button: Sets 'duration' to 'monthly' when clicked -->
                    <!-- Sliding background -->
                    <div class="absolute inset-0 bg-base-50 rounded-md transition-transform duration-200 ease-in-out"
                        :class="duration === 'monthly' ? 'w-1/2 translate-x-0' : 'w-1/2 translate-x-full'"></div>
                    <!-- Monthly Pricing Button -->
                    <button id="monthly-pricing-button"
                        class="relative flex items-center justify-center w-full px-2 h-6 text-xs font-medium focus:outline-none transition-colors duration-300 z-10"
                        :class="duration === 'monthly' ? 'text-accent-600' : 'text-base-500 hover:text-accent-500'"
                        @click="duration = 'monthly'" type="button" :aria-pressed="duration === 'monthly'">
                        Monthly
                    </button>
                    <!-- Annual Pricing Button -->
                    <button id="annual-pricing-button"
                        class="relative flex items-center justify-center w-full px-2 h-6 text-xs font-medium focus:outline-none transition-colors duration-300 z-10"
                        :class="duration === 'annual' ? 'text-accent-600' : 'text-base-500 hover:text-accent-500'"
                        @click="duration = 'annual'" type="button" :aria-pressed="duration === 'annual'">
                        Annual
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mt-12 mx-auto">
                <!-- Tier one -->
                <div class="flex flex-col h-full p-1 lg:py-1 rounded-3xl bg-base-50 shadow">
                    <div>
                        <div class="flex flex-col gap-4 p-8 bg-white rounded-[1.3rem] h-full rounded-3xl shadow">
                            <div class="flex items-start justify-between w-full">
                                <div>
                                    <h3 class="text-lg leading-normal sm:text-xl md:text-2xl font-medium text-base-900">
                                        Core
                                    </h3>
                                    <p class="text-md leading-normal font-medium text-base-500">
                                        For individuals
                                    </p>
                                </div>
                            </div>
                            <p class="text-md leading-normal font-medium text-base-500">
                                This subscription tier caters to individuals and hobbyists seeking
                                features.
                            </p>
                        </div>
                    </div>
                    <div class="p-8">
                        <p
                            class="font-semibold flex lg:text-3xl items-baseline text-2xl tracking-tighter text-base-900">
                            <span data-monthly="$29.00" data-annual="$19.00" x-text="$el.dataset[duration]"></span>
                            <span class="text-sm font-normal font-sans tracking-normal text-base-500">
                                <span x-show="duration === 'monthly'">/month</span>
                                <span x-show="duration === 'annual'" style="display: none">/annually</span>
                            </span>
                        </p>
                        <div class="w-full mt-4">
                            <button
                                class="flex items-center justify-center transition-all duration-200 focus:ring-2 transition-shadow focus:outline-none text-base-500 bg-white hover:text-accent-500 ring-1 ring-base-200 focus:ring-accent-500 h-9 px-4 py-2 text-sm font-medium rounded-md w-full">
                                Get Started
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Tier two -->
                <div class="flex flex-col h-full p-1 lg:py-1 rounded-3xl bg-accent-700 shadow">
                    <div>
                        <div class="flex flex-col gap-4 p-8 bg-white/10 rounded-[1.3rem] h-full rounded-3xl shadow">
                            <div class="flex items-start justify-between w-full">
                                <div>
                                    <h3 class="text-lg leading-normal sm:text-xl md:text-2xl font-medium text-white">
                                        Momentum
                                    </h3>
                                    <p class="text-md leading-normal font-medium text-base-200">
                                        For startups
                                    </p>
                                </div>
                                <span
                                    class="inline-flex items-center font-medium relative text-base-700 bg-base-50 px-2.5 py-1 text-xs rounded-md">
                                    Popular
                                </span>
                            </div>
                            <p class="text-md leading-normal font-medium text-base-200">
                                Tailored for expanding businesses, this tier offers advanced tools
                                and analytics.
                            </p>
                        </div>
                    </div>
                    <div class="p-8">
                        <p class="font-semibold flex lg:text-3xl items-baseline text-2xl tracking-tighter text-white">
                            <span data-monthly="$49.00" data-annual="$39.00" x-text="$el.dataset[duration]"></span>
                            <span class="text-sm font-normal font-sans tracking-normal text-accent-100">
                                <span x-show="duration === 'monthly'">/month</span>
                                <span x-show="duration === 'annual'" style="display: none">/annually</span>
                            </span>
                        </p>
                        <div class="w-full mt-4">
                            <button
                                class="flex items-center justify-center transition-all duration-200 focus:ring-2 transition-shadow focus:outline-none text-base-500 bg-white hover:text-accent-500 ring-1 ring-base-200 focus:ring-accent-500 h-9 px-4 py-2 text-sm font-medium rounded-md w-full">
                                Get Started
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Tier three -->
                <div class="flex flex-col h-full p-1 lg:py-1 rounded-3xl bg-base-50 shadow">
                    <div>
                        <div class="flex flex-col gap-4 p-8 bg-white rounded-[1.3rem] h-full rounded-3xl shadow">
                            <div class="flex items-start justify-between w-full">
                                <div>
                                    <h3
                                        class="text-lg leading-normal sm:text-xl md:text-2xl font-medium text-base-900">
                                        Growth
                                    </h3>
                                    <p class="text-md leading-normal font-medium text-base-500">
                                        For corporates
                                    </p>
                                </div>
                            </div>
                            <p class="text-md leading-normal font-medium text-base-500">
                                Designed for established businesses, providing comprehensive
                                tools.
                            </p>
                        </div>
                    </div>
                    <div class="p-8">
                        <p
                            class="font-semibold flex lg:text-3xl items-baseline text-2xl tracking-tighter text-base-900">
                            <span data-monthly="$99.00" data-annual="$79.00" x-text="$el.dataset[duration]"></span>
                            <span class="text-sm font-normal font-sans tracking-normal text-base-500">
                                <span x-show="duration === 'monthly'">/month</span>
                                <span x-show="duration === 'annual'" style="display: none">/annually</span>
                            </span>
                        </p>
                        <div class="w-full mt-4">
                            <button
                                class="flex items-center justify-center transition-all duration-200 focus:ring-2 transition-shadow focus:outline-none text-base-500 bg-white hover:text-accent-500 ring-1 ring-base-200 focus:ring-accent-500 h-9 px-4 py-2 text-sm font-medium rounded-md w-full">
                                Get Started
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Frequently Asked Questions section -->

    <!-- Footer section with links, contact info, and social media -->
    <section>
        <div class="px-8 py-12 mx-auto md:px-12 lg:px-24 max-w-7xl relative">

            <div class="grid pt-6 mt-6 border-t grid-cols-2 md:grid-cols-4 gap-x-8 gap-y-24">
                <div class="space-y-4">
                    <nav aria-labelledby="footer-heading-0">
                        <h2 class="text-base leading-normal font-semibold text-base-900" id="footer-heading-0">
                            Company
                        </h2>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    About
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Mission
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Leadership Team
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    History
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="space-y-4">
                    <nav aria-labelledby="footer-heading-1">
                        <h2 class="text-base leading-normal font-semibold text-base-900" id="footer-heading-1">
                            Services
                        </h2>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Marketing
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Analytics
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Commerce
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Insights
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="space-y-4">
                    <nav aria-labelledby="footer-heading-2">
                        <h2 class="text-base leading-normal font-semibold text-base-900" id="footer-heading-2">
                            Resources
                        </h2>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Documentation
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Guides
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Webinars
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    White Papers
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="space-y-4">
                    <nav aria-labelledby="footer-heading-3">
                        <h2 class="text-base leading-normal font-semibold text-base-900" id="footer-heading-3">
                            Support &amp; Legal
                        </h2>
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Pricing
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    API Status
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Live Chat
                                </a>
                            </li>
                            <li>
                                <a class="text-md leading-normal hover:text-accent-500 font-medium text-base-500"
                                    href="#_">
                                    Email Support
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="pt-6 mt-12 border-t flex flex-col md:flex-row items-center justify-between">
                <a class="text-md leading-normal hover:text-accent-500 font-medium flex items-center gap-2 text-base-900"
                    href="#_">
                    <img class="h-7 2xl:h-12" src="{{ asset('images/stylesynclogo.png') }}" alt="#_" />

                </a>
                <h2 class="text-sm leading-normal font-medium text-base-400">
                    Copyright © 2024 Stylesync. All rights reserved.
                </h2>
            </div>
        </div>
    </section>



    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
