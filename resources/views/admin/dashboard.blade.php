@section('title', 'Dashboard')
<x-admin-layout>
    <div>
        <div class="grid grid-cols-4 gap-5">
            <div class="bg-gradient-to-bl from-main to-gray-500 p-5 rounded-2xl shadow-md relative overflow-hidden">
                <img src="{{ asset('images/bg1.jpg') }}"
                    class="absolute top-0 bottom-0 w-full h-full object-cover left-0 opacity-10" alt="">
                <div class="mt-5">
                    <h1 class="text-5xl font-black text-white">100</h1>
                    <h1 class="text-gray-200 mt-2 text-sm">Barber Shops</h1>
                </div>
            </div>
            <div class="bg-gradient-to-bl from-main to-gray-500 p-5 rounded-2xl shadow-md relative overflow-hidden">
                <img src="{{ asset('images/bg1.jpg') }}"
                    class="absolute top-0 bottom-0 w-full h-full object-cover left-0 opacity-10" alt="">
                <div class="mt-5">
                    <h1 class="text-5xl font-black text-white">50</h1>
                    <h1 class="text-gray-200 mt-2 text-sm">Barbers</h1>
                </div>
            </div>
            <div class="bg-gradient-to-bl from-main to-gray-500 p-5 rounded-2xl shadow-md relative overflow-hidden">
                <img src="{{ asset('images/bg1.jpg') }}"
                    class="absolute top-0 bottom-0 w-full h-full object-cover left-0 opacity-10" alt="">
                <div class="mt-5">
                    <h1 class="text-5xl font-black text-white">210</h1>
                    <h1 class="text-gray-200 mt-2 text-sm">Services</h1>
                </div>
            </div>
            <div class="bg-gradient-to-bl from-main to-gray-500 p-5 rounded-2xl shadow-md relative overflow-hidden">
                <img src="{{ asset('images/bg1.jpg') }}"
                    class="absolute top-0 bottom-0 w-full h-full object-cover left-0 opacity-10" alt="">
                <div class="mt-5">
                    <h1 class="text-5xl font-black text-white">42</h1>
                    <h1 class="text-gray-200 mt-2 text-sm">Appointments</h1>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
