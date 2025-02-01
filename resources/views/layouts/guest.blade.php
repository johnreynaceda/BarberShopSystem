<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />

    <!-- Leaflet Routing Machine JavaScript -->
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>


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

<body class="font-sans text-gray-900 antialiased overflow-hidden">
    <div
        class="absolute text-stroke font-mont text-stroke-md opacity-20 text-gray-500 top-40 font-extrabold text-[10rem] -left-80">
        STYLESYNC
    </div>
    <div
        class="absolute text-stroke font-mont text-stroke-md opacity-25 text-gray-500 top-[30rem] font-extrabold text-[10rem] right-10">
        STYLESYNC
    </div>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-bl from-main to-gray-500">
        <div class="fixed">
            <img src="{{ asset('images/bg1.jpg') }}" class="bg-cover opacity-20" alt="">
        </div>
        <div class="relative">

        </div>

        <div class="w-full relative sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <center>
                <a href="/">
                    <x-application-logo class=" h-20 fill-current text-gray-500" />
                </a>
            </center>
            <div class="mt-10">
                {{ $slot }}
            </div>
        </div>
    </div>

    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
