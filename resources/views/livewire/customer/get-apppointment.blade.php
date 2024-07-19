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
                    <h1 class="text-gray-300">Please select the service...</h1>
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
                                    class="{{ $services_id == $service_item->id ? 'bg-white text-gray-500' : 'text-white ' }} border rounded-xl hover:bg-white hover:scale-95 cursor-pointer hover:text-gray-700 p-5 grid place-content-center">
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
                    <h1 class="text-gray-300">Please choose the barber...</h1>
                    <div class="mt-5 grid 2xl:grid-cols-5 grid-cols-2 gap-3  2xl:gap-5">
                        @foreach ($barbers as $barber)
                            <div wire:click="$set('barber_id', {{ $barber->id }})"
                                class="{{ $barber_id == $barber->id ? 'bg-white text-gray-500' : 'text-white ' }} border rounded-xl hover:bg-white hover:scale-95 cursor-pointer hover:text-gray-700 p-5 grid place-content-center">
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
        </div>
    @break

    @case(3)
        <div class="mt-10">
            <div>
                <h1 class="text-gray-300">Please choose the date and time...</h1>
                <div class="w-80">
                    <x-datetime-picker wire:model.live="date_of_appointment" label="Appointment Date"
                        placeholder="Appointment Date" />

                </div>

            </div>
            @if ($date_of_appointment)
                <div class="mt-10">
                    <x-button label="Sumbit Appointment" class="font-medium" right-icon="check" positive
                        wire:click="previewRecord" spinner="previewRecord" />
                </div>
            @endif
        </div>
    @break

    @default
@endswitch

<x-modal name="preview_modal" wire:model.defer="preview_modal">
    <x-card title="PREVIEW APPOINTMENT">
        <div class="2xl:w-[30rem]">
            <div class="w-full grid grid-cols-4 gap-2">
                <h1 class="col-span-2">Category:</h1>
                <h1 class="col-span-2">{{ \App\Models\ServiceCategory::where('id', $service_id)->first()->name ?? '' }}
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
                <h1 class="col-span-2">{{ auth()->user()->customerInformation->address }}</h1>
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

            <x-button primary label="I Agree" wire:click="agree" />
        </x-slot>
    </x-card>
</x-modal>
</div>
