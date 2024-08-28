<div>
    <div class="justify-center w-full mx-auto  bg-white">
        <div x-data="{ open: false }"
            class="flex flex-col w-full px-8 py-2 mx-auto md:px-12 md:items-center md:justify-between md:flex-row lg:px-32 max-w-7xl">
            <div class="flex flex-row items-center justify-between text-accent-500">
                <a class="inline-flex items-center gap-3 text-xl font-bold tracking-tight text-black" href="/">
                    <img src="{{ asset('images/stylesynclogo.png') }}" class="h-16" alt="">
                </a><button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline" @click="open = !open">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{ 'flex': open, 'hidden': !open }"
                class="flex-col items-center flex-grow hidden p-4 px-5 opacity-100 md:px-0 md:pb-0 md:flex md:justify-start md:flex-row lg:p-0 md:mt-0">
                @if (auth()->check())
                    @if (auth()->user()->user_type == 'barber')
                        <div class="md:ml-auto 2xl:mr-20 ">

                            <a class="{{ request()->routeIs('barber.dashboard') ? 'font-semibold' : '' }} px-2 py-2 text-sm  text-main hover:font-semibold hover:scale-75 focus:outline-none focus:shadow-none focus:text-black/90 md:ml-auto"
                                href="{{ route('barber.dashboard') }}">Appointments({{ \App\Models\Appointment::where('barber_id', auth()->user()->barber->id)->where('status', 'pending')->get()->count() }})</a>
                            <a class="{{ request()->routeIs('barber.transactions') ? 'font-semibold' : '' }} px-2 py-2 text-sm  text-main hover:font-semibold hover:scale-75 focus:outline-none focus:shadow-none focus:text-black/90 md:ml-auto"
                                href="{{ route('barber.transactions') }}">Transaction({{ \App\Models\Transaction::where('barber_id', auth()->user()->barber->id)->where('status', 'pending')->get()->count() }})</a>

                        </div>
                    @elseif(auth()->user()->user_type == 'customer')
                        <div class="md:ml-auto">
                            <a class="{{ request()->routeIs('customer.dashboard') ? 'font-semibold' : '' }} px-2 py-2 text-sm  text-main hover:font-semibold hover:scale-75 focus:outline-none focus:shadow-none focus:text-black/90 md:ml-auto"
                                href="{{ route('customer.dashboard') }}">Home </a>
                            <a class="{{ request()->routeIs('customer.barber-shops') ? 'font-semibold' : '' }} px-2 py-2 text-sm  text-main hover:font-semibold hover:scale-75 focus:outline-none focus:shadow-none focus:text-black/90 md:ml-auto"
                                href="{{ route('customer.barber-shops') }}">Barber Shops </a>
                            <a class="{{ request()->routeIs('customer.appointment') ? 'font-semibold' : '' }} px-2 py-2 text-sm  text-main hover:font-semibold hover:scale-75 focus:outline-none focus:shadow-none focus:text-black/90 md:ml-auto"
                                href="{{ route('customer.appointments') }}">Appointments</a>
                            <a class="px-2 py-2 text-sm  text-main hover:font-semibold hover:scale-75 focus:outline-none focus:shadow-none focus:text-black/90 md:ml-auto"
                                href="#features">Notifications</a>
                        </div>
                    @else
                    @endif
                    <livewire:customer-userdropdown />
                @else
                    <a class="px-4 py-2 text-xs text-gray-500 hover:text-black focus:outline-none focus:shadow-none focus:text-black/90 md:ml-auto"
                        href="#features">Features </a>
                    <x-button label="Sign In" href="{{ route('register') }}" class="font-semibold" slate
                        rounded="lg" />
                @endif
            </nav>
        </div>
    </div>
</div>
