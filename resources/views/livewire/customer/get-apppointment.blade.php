<div>
    <div class="flex space-x-2 items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="text-white" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-building-store">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 21l18 0" />
            <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
            <path d="M5 21l0 -10.15" />
            <path d="M19 21l0 -10.15" />
            <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
        </svg>
        <h1 class="text-white text-2xl font-bold">{{ $shop->name }}</h1>
    </div>
    @switch($steps)
        @case(1)
            <div class="mt-10">
                <div>
                    <h1 class="text-gray-500">Please select the service...</h1>
                    <div class="mt-5 grid 2xl:grid-cols-6 grid-cols-4 gap-3  2xl:gap-5">
                        @foreach ($services as $service)
                            <x-button label="{{ $service->name }}" slate class="font-semibold"
                                wire:click="$set('service_id', {{ $service->id }})" />
                        @endforeach
                    </div>
                    @if ($service_id)
                        <div class="mt-5 grid 2xl:grid-cols-6 grid-cols-2 gap-3  2xl:gap-5 rounded-lg ">
                            @forelse ($servicess as $service_item)
                                <div wire:click="$set('services_id', {{ $service_item->id }})"
                                    spinner="$set('services_id', {{ $service_item->id }}"
                                    class="{{ $services_id == $service_item->id ? 'bg-gray-700 text-white' : ' ' }} border rounded-xl hover:bg-gray-600 active:bg-gray-700 active:text-white hover:text-white hover:scale-95 cursor-pointer  p-5 grid place-content-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-scissors">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M6 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M6 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        <path d="M8.6 8.6l10.4 10.4" />
                                        <path d="M8.6 15.4l10.4 -10.4" />
                                    </svg>
                                    <div class="mt-2">
                                        <h1 class="uppercase font-bold ">
                                            {{ $service_item->name }}</h1>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                        @if ($services_id)
                            <div class="mt-10">
                                <x-button label="NEXT | Select Barber" class="font-medium" right-icon="arrow-right" positive
                                    wire:click="next" spinner="next" />
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @break

        @case(2)
            <div class="mt-10">
                <div>
                    <h1 class="text-gray-500">Please choose the barber...</h1>
                    <div class="mt-5 grid 2xl:grid-cols-5 grid-cols-2 gap-3  2xl:gap-5">
                        @foreach ($barbers as $barber)
                            <div wire:click="$set('barber_id', {{ $barber->id }})"
                                class="{{ $barber_id == $barber->id ? 'bg-gray-600 text-white' : 'text-gray-700 ' }} border rounded-xl hover:bg-gray-600 hover:text-white hover:scale-95 cursor-pointer hover:text-gray-700 p-5 grid place-content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" class=""
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-search">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h1.5" />
                                    <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                    <path d="M20.2 20.2l1.8 1.8" />
                                </svg>
                                <div class="mt-2">
                                    <h1 class="uppercase font-bold ">
                                        {{ $barber->firstname . ' ' . $barber->lastname }}</h1>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($barber_id)
                        <div class="mt-10">
                            <x-button label="NEXT | Select Date" class="font-medium" right-icon="calendar" positive
                                wire:click="next" spinner="next" />
                        </div>
                    @endif
                </div>
            </div>
            <div class="mt-20">
                <section class="flex items-center justify-center py-20 bg-white min-w-screen">
                    <div class="px-16 bg-white">
                        <div class="container flex flex-col items-start mx-auto lg:items-center">
                            <p class="relative flex items-start justify-start w-full text-lg font-bold tracking-wider text-purple-500 uppercase lg:justify-center lg:items-center"
                                data-primary="purple-500">Don't just take our word for it</p>


                            <h2
                                class="relative flex items-start justify-start w-full max-w-3xl text-3xl font-bold lg:justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                    class="absolute right-0 hidden w-12 h-12 -mt-2 -mr-16 text-gray-200 lg:inline-block"
                                    viewBox="0 0 975.036 975.036">
                                    <path
                                        d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                                    </path>
                                </svg>
                                See what others are saying
                            </h2>
                            <div class="block w-full h-0.5 max-w-lg mt-6 bg-purple-100 rounded-full" data-primary="purple-600">
                            </div>

                            <div class="items-center justify-center w-full mt-12 mb-4 lg:flex">
                                @forelse ($feedbacks as $item)
                                    <div class="flex flex-col items-start justify-start w-full h-auto mb-12 lg:w-1/3 lg:mb-0">
                                        <blockquote class="mt-8 text-lg text-gray-500">"{{ $item->feedback }}"</blockquote>
                                        <div class="flex space-x-2">
                                            <span>{{ $item->rate }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                class="text-yellow-500 h-5 w-5" fill="currentColor">
                                                <path
                                                    d="M11.9998 17L6.12197 20.5902L7.72007 13.8906L2.48926 9.40983L9.35479 8.85942L11.9998 2.5L14.6449 8.85942L21.5104 9.40983L16.2796 13.8906L17.8777 20.5902L11.9998 17Z">
                                                </path>
                                            </svg>

                                        </div>
                                    </div>
                                @empty
                                    <div>
                                        <h1 class="text-gray-500">No feedbacks yet...</h1>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    @break

    @case(3)
        <div class="mt-10">
            <div>
                <h1 class="text-gray-500">Please choose the date and time...</h1>
                <div class="w-80">
                    <x-datetime-picker wire:model.live="date_of_appointment" without-timezone placeholder="Appointment Date" />

                    <div class="mt-5">
                        <h1>Schedules:</h1>
                        <div class="mt-2">
                            <ul class="space-y-1">
                                @forelse ($appointments as $item)
                                    <li>{{ \Carbon\Carbon::parse($item->date)->format('F d, Y h:i A') }}</li>
                                @empty
                                    <li>No record...</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            @if ($date_of_appointment)
                <div class="mt-10">
                    <x-button label="Preview Appointment" class="font-medium" right-icon="check" positive
                        wire:click="previewRecord" spinner="previewRecord" />
                </div>
            @endif
        </div>
    @break

    @default
@endswitch

<x-modal name="preview_modal" wire:model.defer="preview_modal" align="center">
    <x-card title="PREVIEW APPOINTMENT">
        <div class="2xl:w-[30rem]">
            <div class="w-full grid grid-cols-4 gap-2">
                <h1 class="col-span-2">Category:</h1>
                <h1 class="col-span-2">
                    {{ \App\Models\ServiceCategory::where('id', $service_id)->first()->name ?? '' }}
                </h1>
                <h1 class="col-span-2">Price:</h1>
                <h1 class="col-span-2">
                    &#8369;{{ number_format(\App\Models\Service::where('id', $services_id)->first()->amount ?? 0, 2) }}
                </h1>
                <h1 class="col-span-2">Service Name:</h1>
                <h1 class="col-span-2">{{ \App\Models\Service::where('id', $services_id)->first()->name ?? '' }}</h1>
                <h1 class="col-span-2">Name:</h1>
                <h1 class="col-span-2">{{ auth()->user()->name }}</h1>
                <h1 class="col-span-2">Address:</h1>
                <h1 class="col-span-2">{{ auth()->user()->customerInformation->address ?? '' }}</h1>
                <h1 class="col-span-2">Date & Time:</h1>
                <h1 class="col-span-2">{{ \Carbon\Carbon::parse($date_of_appointment ?? '')->format('F d, Y H:i A') }}
                </h1>
                <h1 class="col-span-2">Barber:</h1>
                <h1 class="col-span-2">
                    {{ (\App\Models\Barber::where('id', $barber_id)->first()->firstname ?? '') . ' ' . (\App\Models\Barber::where('id', $barber_id)->first()->firstname ?? '') }}
                </h1>
                <h1 class="col-span-2">Contact No.:</h1>
                <h1 class="col-span-2">{{ \App\Models\Barber::where('id', $barber_id)->first()->contact ?? '' }}
                </h1>
                <h1 class="col-span-2">Mode of Payment:</h1>
                <div class="col-span-2">
                    <x-native-select wire:model.live="mode_of_payment">
                        <option>Select An Option</option>
                        <option>Cash</option>
                        <option>Gcash</option>
                    </x-native-select>
                </div>
            </div>
        </div>

        <x-slot name="footer" class="flex justify-end gap-x-4">
            <x-button flat label="Cancel" x-on:click="close" />

            <x-button primary label="Submit Appointment" wire:click="submitAppointment" spinner="submitAppointment"
                slate />
        </x-slot>
    </x-card>
</x-modal>
</div>
