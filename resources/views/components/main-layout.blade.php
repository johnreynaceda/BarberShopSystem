<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">

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

    <main class="bg-gradient-to-br from-gray-500  to-gray-700">
        <livewire:navbar />

        <section class="scroll-mt-24 relative" id="features">
            <img src="{{ asset('images/bg1.jpg') }}"
                class="absolute opacity-50 top-0 bottom-0 h-full w-full object-cover" alt="">
            <div
                class="absolute text-stroke font-mont text-stroke-md opacity-10 text-gray-500 top-40 font-extrabold text-[10rem] -left-80">
                STYLESYNC
            </div>
            <div class="px-8 py-20  mx-auto  relative md:px-12 lg:px-32 max-w-7xl">

                {{ $slot }}
            </div>
        </section>


        <footer>
            <div class="h-full px-8 py-24 mx-auto md:px-12 lg:px-32 max-w-7xl">
                <div class="pt-12 border-t border-gray-300 xl:grid xl:grid-cols-3 xl:gap-8">
                    <div class="text-black">
                        <div class="inline-flex items-center gap-3">
                            <p class="text-2xl font-bold uppercase">Appify</p>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 lg:w-4/5">
                            Windstatic, basic and sturdy themes under the creative commons
                            license.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-8 mt-12 lg:grid-cols-3 lg:mt-0 xl:col-span-2">
                        <div>
                            <h3 class="text-black">Information</h3>
                            <ul role="list" class="mt-4 space-y-2">
                                <li>
                                    <a href="#_" class="text-sm text-gray-500 hover:text-black">
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
                                        class="text-sm text-gray-500 hover:text-black">
                                        @lexingtonthemes
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/Mike_Andreuzza"
                                        class="text-sm text-gray-500 hover:text-black">
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
                                        class="text-sm text-gray-500 hover:text-black">
                                        Lexington Themes
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col pt-12 md:flex-row md:items-center md:justify-between">
                    <p class="text-left">
                        <span class="mx-auto mt-2 text-sm text-gray-500 lg:mx-0">
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
    @filamentScripts
    @vite('resources/js/app.js')
</body>

</html>
