<x-main-layout>
    <div>
        <h1 class="text-white font-bold text-2xl">BARBER SHOPS</h1>
        <ul role="list" class="grid max-w-2xl grid-cols-1 gap-6 mx-auto mt-12 sm:gap-4 lg:max-w-none lg:grid-cols-3">
            @forelse (\App\Models\Shop::all() as $item)
                <li class="p-2 border bg-gray-50 rounded-3xl">
                    <figure
                        class="relative flex flex-col justify-between h-full p-6 bg-white  border shadow-lg rounded-2xl">
                        <blockquote class="relative">

                        </blockquote>
                        <figcaption class="relative flex items-start justify-between ">
                            <div class="w-64">
                                <p class="font-bold uppercase text-xl text-gray-800">{{ $item->name }} </p>

                            </div>
                            <div class="overflow-hidden rounded-full bg-gray-50">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-scissors">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M6 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M6 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M8.6 8.6l10.4 10.4" />
                                    <path d="M8.6 15.4l10.4 -10.4" />
                                </svg>
                            </div>
                        </figcaption>
                        <div class="mt-3 space-y-2">
                            <div class="flex space-x-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    class="text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-location-pin">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 18l-2 -4l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5l-2.901 8.034" />
                                    <path
                                        d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                                    <path d="M19 18v.01" />
                                </svg>
                                <p>{{ $item->address }}</p>
                            </div>
                            <div class="flex space-x-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    class="text-red-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-address-book">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z" />
                                    <path d="M10 16h6" />
                                    <path d="M13 11m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                    <path d="M4 8h3" />
                                    <path d="M4 12h3" />
                                    <path d="M4 16h3" />
                                </svg>
                                <p>{{ $item->contact }}</p>
                            </div>
                        </div>

                        <div class="mt-10">
                            <x-button label="Get Appointment" class="w-full font-semibold" right-icon="arrow-right"
                                href="{{ route('customer.get-appointment', ['id' => $item->id]) }}" />
                        </div>
                    </figure>
                </li>
            @empty
            @endforelse

        </ul>
    </div>
</x-main-layout>
