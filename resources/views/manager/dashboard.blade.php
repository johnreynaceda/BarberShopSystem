@section('title', 'Dashboard')
<x-manager-layout>
    <div>
        <div class="grid grid-cols-4 gap-5">

            <div class="bg-gradient-to-bl from-main to-gray-500 p-5 rounded-2xl shadow-md relative overflow-hidden">
                <img src="{{ asset('images/bg1.jpg') }}"
                    class="absolute top-0 bottom-0 w-full h-full object-cover left-0 opacity-10" alt="">
                <div class="mt-5">
                    <h1 class="text-5xl font-black text-white">
                        {{ \App\Models\Barber::where('shop_id', auth()->user()->shop_id)->count() }}</h1>
                    <h1 class="text-gray-200 mt-2 text-sm">Barbers</h1>
                </div>
            </div>
            <div class="bg-gradient-to-bl from-main to-gray-500 p-5 rounded-2xl shadow-md relative overflow-hidden">
                <img src="{{ asset('images/bg1.jpg') }}"
                    class="absolute top-0 bottom-0 w-full h-full object-cover left-0 opacity-10" alt="">
                <div class="mt-5">
                    <h1 class="text-5xl font-black text-white">
                        {{ \App\Models\Service::whereHas('serviceCategory', function ($record) {
                            $record->where('shop_id', auth()->user()->shop_id);
                        })->count() }}
                    </h1>
                    <h1 class="text-gray-200 mt-2 text-sm">Services</h1>
                </div>
            </div>
            <div class="bg-gradient-to-bl from-main to-gray-500 p-5 rounded-2xl shadow-md relative overflow-hidden">
                <img src="{{ asset('images/bg1.jpg') }}"
                    class="absolute top-0 bottom-0 w-full h-full object-cover left-0 opacity-10" alt="">
                <div class="mt-5">
                    <h1 class="text-5xl font-black text-white">
                        {{ \App\Models\Appointment::where('shop_id', auth()->user()->shop_id)->count() }}</h1>
                    <h1 class="text-gray-200 mt-2 text-sm">Appointments</h1>
                </div>
            </div>
        </div>
    </div>
</x-manager-layout>
