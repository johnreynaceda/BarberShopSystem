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


    <div class="justify-center w-full mx-auto border-b bg-base-50">
        <livewire:navbar />
    </div>

    <section class="py-20">
        <div class="2xl:px-5 px-2  mx-auto  max-w-7xl  relative">
            {{ $slot }}
        </div>
    </section>

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
