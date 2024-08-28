<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
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

    <main class="bg-gradient-to-r from-gray-500 via-gray-500 to-gray-600">
        <div class="justify-center w-full mx-auto bg-white">
            <div x-data="{ open: false }"
                class="flex flex-col w-full px-8 py-2 mx-auto md:px-12 md:items-center md:justify-between md:flex-row lg:px-32 max-w-7xl">
                <div class="flex flex-row items-center justify-between text-accent-500">
                    <a class="inline-flex items-center gap-3 text-xl font-bold tracking-tight text-black"
                        href="/">
                        <img src="{{ asset('images/stylesynclogo.png') }}" class="h-16" alt="">
                    </a>
                    <x-button label="Login" right-icon="arrow-left-end-on-rectangle" class="2xl:hidden " slate
                        href="{{ route('login') }}" />
                </div>
                <nav :class="{ 'flex': open, 'hidden': !open }"
                    class="flex-col items-center flex-grow hidden p-4 px-5 opacity-100 md:px-0 md:pb-0 md:flex md:justify-start md:flex-row lg:p-0 md:mt-0">
                    <a class="px-4 py-2 text-xs text-gray-500 hover:text-black focus:outline-none focus:shadow-none focus:text-black/90 md:ml-auto"
                        href="#features">Features </a>
                    <x-button label="Sign In" href="{{ route('login') }}" class="font-semibold" slate rounded="lg" />
                </nav>
            </div>
        </div>

        <section class="scroll-mt-24 relative" id="features">
            <img src="{{ asset('images/bg1.jpg') }}"
                class="absolute opacity-60 top-0 bottom-0 h-full w-full object-cover" alt="">
            <div
                class="absolute text-stroke font-mont text-stroke-md opacity-10 text-gray-500 top-40 font-extrabold 2xl:text-[10rem] -left-80">
                STYLESYNC
            </div>
            <div class="px-8 py-24 pb-96 mx-auto text-center relative md:px-12 lg:px-32 max-w-7xl">
                <div>
                    <p class="mt-12 2xl:text-6xl text-4xl font-semibold  text-white ">
                        Syncing You with the Best Barbershops
                        <span class="text-gray-300 tracking-tighter text-3xl md:block">Effortlessly find the best
                            barbers near
                            you.</span>
                    </p>

                </div>

            </div>
        </section>

        <section class="relative -mt-96">
            <div
                class="absolute text-stroke font-mont text-stroke-md opacity-25 text-gray-500 top-[30rem] font-extrabold text-[10rem] right-10">
                STYLESYNC
            </div>
            <div class="px-8 py-12 mx-auto md:px-12 lg:px-32 max-w-7xl">
                <div>
                    <p class="mt-12  font-semibold tracking-tighter text-white 2xl:text-lg lg:text-5xl">
                        Our customers pretend
                        <span class="text-gray-300 hidden 2xl:block 2xl:text-4xl md:block">they love us and our
                            website</span>
                    </p>
                    <p class="text-gray-300 2xl:hidden  2xl:text-4xl md:block">they love us and our
                        website</p>
                </div>
                <ul role="list"
                    class="grid max-w-2xl grid-cols-1 gap-6 mx-auto mt-12 sm:gap-4 lg:max-w-none lg:grid-cols-3">
                    <li class="p-2 border bg-gray-50 rounded-3xl">
                        <figure
                            class="relative flex flex-col justify-between h-full p-6 bg-white border shadow-lg rounded-2xl">
                            <blockquote class="relative">
                                <p class="text-base text-gray-500">
                                    Being in the financial industry, we were always looking for ways
                                    to enhance our transactions' security and efficiency.
                                </p>
                            </blockquote>
                            <figcaption class="relative flex items-center justify-between pt-6 mt-6">
                                <div>
                                    <div class="font-medium text-gray-900">Michael Andreuzza</div>
                                    <div class="mt-1 text-sm text-gray-100">
                                        Creator of Windstatic.com
                                    </div>
                                </div>
                                <div class="overflow-hidden rounded-full bg-gray-50">
                                    <img alt="" src="/images/appify/avatar1.png" width="56" height="56"
                                        decoding="async" data-nimg="future" class="object-cover h-14 w-14 grayscale"
                                        loading="lazy" style="color: transparent">
                                </div>
                            </figcaption>
                        </figure>
                    </li>
                    <li class="p-2 border bg-gray-50 rounded-3xl">
                        <figure
                            class="relative flex flex-col justify-between h-full p-6 bg-white border shadow-lg rounded-2xl">
                            <blockquote class="relative">
                                <p class="text-base text-gray-500">
                                    Implementing Semplice's blockchain technology has been a
                                    game-changer for our supply chain management.
                                </p>
                            </blockquote>
                            <figcaption class="relative flex items-center justify-between pt-6 mt-6">
                                <div>
                                    <div class="font-medium text-gray-900">Michael Andreuzza</div>
                                    <div class="mt-1 text-sm text-gray-100">
                                        Creator of Lexington Themes
                                    </div>
                                </div>
                                <div class="overflow-hidden rounded-full bg-gray-50">
                                    <img alt="" src="/images/appify/avatar2.png" width="56" height="56"
                                        decoding="async" data-nimg="future" class="object-cover h-14 w-14 grayscale"
                                        loading="lazy" style="color: transparent">
                                </div>
                            </figcaption>
                        </figure>
                    </li>
                    <li class="p-2 border bg-gray-50 rounded-3xl">
                        <figure
                            class="relative flex flex-col justify-between h-full p-6 bg-white border shadow-lg rounded-2xl">
                            <blockquote class="relative">
                                <p class="text-base text-gray-500">
                                    We were initially hesitant about integrating blockchain
                                    technology into our existing systems, fearing the complexity of
                                    the process.
                                </p>
                            </blockquote>
                            <figcaption class="relative flex items-center justify-between pt-6 mt-6">
                                <div>
                                    <div class="font-medium text-gray-900">Jenson Button</div>
                                    <div class="mt-1 text-sm text-gray-100">
                                        Founder of Benji and Tom
                                    </div>
                                </div>
                                <div class="overflow-hidden rounded-full bg-gray-50">
                                    <img alt="" src="/images/appify/avatar3.png" width="56" height="56"
                                        decoding="async" data-nimg="future" class="object-cover h-14 w-14 grayscale"
                                        loading="lazy" style="color: transparent">
                                </div>
                            </figcaption>
                        </figure>
                    </li>
                </ul>
            </div>
        </section>
        <section class="relative">
            <div class="px-8 py-12 mx-auto md:px-12 lg:px-32 max-w-7xl">
                <div class="p-2 border bg-gray-50 rounded-3xl">
                    <div class="p-10 text-center bg-white border shadow-lg md:p-20 rounded-3xl">
                        <p class="text-4xl font-semibold tracking-tighter text-black">
                            Download our app today
                        </p>
                        <p class="mt-4 text-base text-gray-500">
                            The fastest method for working together
                            <span class="md:block">
                                on staging and temporary environments.</span>
                        </p>
                        <div class="flex flex-col items-center justify-center gap-2 mx-auto mt-8 md:flex-row">
                            <button
                                class="inline-flex items-center justify-center w-full h-12 gap-3 px-5 py-3 bg-gray-100 md:w-auto rounded-xl hover:bg-gray-200 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-4"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M99.617 8.057a50.191 50.191 0 00-38.815-6.713l230.932 230.933 74.846-74.846L99.617 8.057zM32.139 20.116c-6.441 8.563-10.148 19.077-10.148 30.199v411.358c0 11.123 3.708 21.636 10.148 30.199l235.877-235.877L32.139 20.116zM464.261 212.087l-67.266-37.637-81.544 81.544 81.548 81.548 67.273-37.64c16.117-9.03 25.738-25.442 25.738-43.908s-9.621-34.877-25.749-43.907zM291.733 279.711L60.815 510.629c3.786.891 7.639 1.371 11.492 1.371a50.275 50.275 0 0027.31-8.07l266.965-149.372-74.849-74.847z">
                                    </path>
                                </svg><span class="text-xs text-gray-600">Download on Google
                                    Play</span></button><button
                                class="inline-flex items-center justify-center w-full h-12 gap-3 px-5 py-3 bg-gray-100 md:w-auto rounded-xl hover:bg-gray-200 focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-4"
                                    viewBox="0 0 305 305">
                                    <path
                                        d="M40.74 112.12c-25.79 44.74-9.4 112.65 19.12 153.82C74.09 286.52 88.5 305 108.24 305c.37 0 .74 0 1.13-.02 9.27-.37 15.97-3.23 22.45-5.99 7.27-3.1 14.8-6.3 26.6-6.3 11.22 0 18.39 3.1 25.31 6.1 6.83 2.95 13.87 6 24.26 5.81 22.23-.41 35.88-20.35 47.92-37.94a168.18 168.18 0 0021-43l.09-.28a2.5 2.5 0 00-1.33-3.06l-.18-.08c-3.92-1.6-38.26-16.84-38.62-58.36-.34-33.74 25.76-51.6 31-54.84l.24-.15a2.5 2.5 0 00.7-3.51c-18-26.37-45.62-30.34-56.73-30.82a50.04 50.04 0 00-4.95-.24c-13.06 0-25.56 4.93-35.61 8.9-6.94 2.73-12.93 5.09-17.06 5.09-4.64 0-10.67-2.4-17.65-5.16-9.33-3.7-19.9-7.9-31.1-7.9l-.79.01c-26.03.38-50.62 15.27-64.18 38.86z">
                                    </path>
                                    <path
                                        d="M212.1 0c-15.76.64-34.67 10.35-45.97 23.58-9.6 11.13-19 29.68-16.52 48.38a2.5 2.5 0 002.29 2.17c1.06.08 2.15.12 3.23.12 15.41 0 32.04-8.52 43.4-22.25 11.94-14.5 17.99-33.1 16.16-49.77A2.52 2.52 0 00212.1 0z">
                                    </path>
                                </svg><span class="text-xs text-gray-600">Download on App Store</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <div id="map" class="w-full h-96"></div>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            function initMap(lat, lon) {
                var map = L.map('map').setView([lat, lon], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([lat, lon]).addTo(map)
                    .bindPopup('<b>You are here!</b>')
                    .openPopup();
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    initMap(lat, lon);
                }, function(error) {
                    console.error('Error getting location: ', error);
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        </script> --}}
        <footer>
            <div class="h-full px-8 py-24 mx-auto md:px-12 lg:px-32 max-w-7xl">
                <div class="pt-12 border-t border-gray-300 xl:grid xl:grid-cols-3 xl:gap-8">
                    <div class="text-white">
                        <div class="inline-flex items-center gap-3">
                            <p class="text-2xl font-bold uppercase">STYLESYNC</p>
                        </div>
                        <p class="mt-2 text-sm text-gray-100 lg:w-4/5">
                            Windstatic, basic and sturdy themes under the creative commons
                            license.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-8 mt-12 lg:grid-cols-3 lg:mt-0 xl:col-span-2">
                        <div>
                            <h3 class="text-black">Information</h3>
                            <ul role="list" class="mt-4 space-y-2">
                                <li>
                                    <a href="#_" class="text-sm text-gray-100 hover:text-black">
                                        License
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-black">Socials</h3>
                            <ul role="list" class="mt-4 space-y-2">
                                <li>
                                    <a href="https://twitter.com/lexingtonthemes"
                                        class="text-sm text-gray-100 hover:text-black">
                                        @lexingtonthemes
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/Mike_Andreuzza"
                                        class="text-sm text-gray-100 hover:text-black">
                                        @Mike_Andreuzza
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-12 md:mt-0">
                            <h3 class="text-black">Premium Themes</h3>
                            <ul role="list" class="mt-4 space-y-2">
                                <li>
                                    <a href="https://lexingtonthemes.com/"
                                        class="text-sm text-gray-100 hover:text-black">
                                        Lexington Themes
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col pt-12 md:flex-row md:items-center md:justify-between">
                    <p class="text-left">
                        <span class="mx-auto mt-2 text-sm text-gray-100 lg:mx-0">
                            © Windstatic. By:
                            <a class="text-accent-500 hover:text-accent-600"
                                href="https://michaelandreuzza.com/">Michael Andreuzza</a>
                            Demo Images: Respective owners.
                        </span>
                    </p>
                </div>
            </div>
        </footer>
    </main>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
