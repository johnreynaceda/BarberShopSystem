<div x-data>
    <div>
        <div class="w-96 ">
            {{ $this->form }}
        </div>

    </div>

    <div class="mt-10">
        @switch($get_report)
            @case('Income')
                <div class="bg-white p-10 rounded-xl">
                    <div class="flex space-x-3 my-5">
                        <div class="w-64 ">
                            <x-input placeholder="Search..." wire:model.live="search" />
                        </div>
                        <div class="w-64 ">
                            <x-native-select wire:model.live="type">
                                <option>Select type</option>
                                <option>Daily</option>
                                <option>Weekly</option>
                                <option>Monthly</option>
                            </x-native-select>
                        </div>
                    </div>
                    <div x-ref="printContainer">
                        <div class="mt-10 mb-3">
                            <h1 class=" uppercase font-bold text-xl">{{ auth()->user()->shop->name }}</h1>
                            <h1 class=" leading-3 text-sm uppercase">{{ $type }} INCOME REPORT</h1>
                        </div>
                        <table id="example" style="width:100%">
                            <thead class="font-normal">
                                <tr>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">CUSTOMER NAME
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        SERVICE
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        BARBER
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        AMOUNT
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        DATE & TIME
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        CUSTOMER TYPE
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        MODE OF PAYMENT
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        BARBER INCOME
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        SHOP INCOME
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @forelse ($incomes as $item)
                                    <tr>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->customer_name }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->service_name }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->barber_name }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">
                                            &#8369;{{ number_format($item->amount, 2) }}
                                        </td>
                                        <td class="border  text-gray-700  px-3 py-1">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y ') }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->customer_type }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->mode_of_payment }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">
                                            &#8369;{{ number_format($item->barber_commission, 2) }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">
                                            &#8369;{{ number_format($item->amount - ($item->barber_commission + $item->admin_commission), 2) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center border  text-gray-700  px-3 py-1">
                                            <span>No Data Available...</span>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <div class="mt-10">
                            <div class="w-64 text-center">
                                <h1 class="border-b-2 text-transparent border-black">asdasdasdasdasdasdasdasd</h1>
                                <span class="font-bold text-center">SHOP MANAGER</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <x-button label="Print Report" icon="printer" slate
                            @click="printOut($refs.printContainer.outerHTML);" />
                    </div>
                </div>
            @break

            @case('Barbers')
                <div class="bg-white p-10 rounded-xl">
                    <div class="flex space-x-3 my-5">
                        <div class="w-64 ">
                            <x-input placeholder="Search..." wire:model.live="search" />
                        </div>
                    </div>
                    <div x-ref="printContainer">
                        <div class="mt-10 mb-3">
                            <h1 class=" uppercase font-bold text-xl">{{ auth()->user()->shop->name }}</h1>
                            <h1 class="text-2xl uppercase">BARBER'S INFORMATION</h1>
                        </div>
                        <table id="example" style="width:100%">
                            <thead class="font-normal">
                                <tr>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        FIRSTNAME
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        LASTNAME
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        ADDRESS
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        CONTACT NUMBER
                                    </th>


                                </tr>
                            </thead>
                            <tbody class="">
                                @forelse ($barbers as $item)
                                    <tr>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->firstname }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->lastname }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->address }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">
                                            {{ $item->contact }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center border  text-gray-700  px-3 py-1">
                                            <span>No Data Available...</span>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">
                        <x-button label="Print Report" icon="printer" slate
                            @click="printOut($refs.printContainer.outerHTML);" />
                    </div>
                </div>
            @break

            @case('Services')
                <div class="bg-white p-10 rounded-xl">
                    <div class="flex space-x-3 my-5">
                        <div class="w-64 ">
                            <x-input placeholder="Search..." wire:model.live="search" />
                        </div>
                    </div>
                    <div x-ref="printContainer">
                        <div class="mt-10 mb-3">
                            <h1 class="text-2xl uppercase">SERVICE'S INFORMATION</h1>
                        </div>
                        <table id="example" style="width:100%">
                            <thead class="font-normal">
                                <tr>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        SERVICE NAME
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        PRICE
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        CATEGORY
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @forelse ($services as $item)
                                    <tr>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->name }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">
                                            &#8369;{{ number_format($item->amount, 2) }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->serviceCategory->name }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center border  text-gray-700  px-3 py-1">
                                            <span>No Data Available...</span>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">
                        <x-button label="Print Report" icon="printer" slate
                            @click="printOut($refs.printContainer.outerHTML);" />
                    </div>
                </div>
            @break

            @case('Appointments')
                <div class="bg-white p-10 rounded-xl">
                    <div class="flex space-x-3 my-5">
                        <div class="w-64 ">
                            <x-input placeholder="Search..." wire:model.live="search" />
                        </div>
                    </div>
                    <div x-ref="printContainer">
                        <div class="mt-10 mb-3">
                            <h1 class="text-2xl uppercase">APPOINTMENT'S INFORMATION</h1>
                        </div>
                        <table id="example" style="width:100%">
                            <thead class="font-normal">
                                <tr>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">CUSTOMER NAME
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        SERVICE
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        BARBER
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        AMOUNT
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        DATE & TIME
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        CUSTOMER TYPE
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        MODE OF PAYMENT
                                    </th>
                                    <th class="border  text-left px-2 text-sm font-semibold text-gray-700 py-2">
                                        STATUS
                                    </th>

                                </tr>
                            </thead>
                            <tbody class="">
                                @forelse ($incomes as $item)
                                    <tr>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->customer_name }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->service_name }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->barber_name }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">
                                            &#8369;{{ number_format($item->amount, 2) }}
                                        </td>
                                        <td class="border  text-gray-700  px-3 py-1">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y ') }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->customer_type }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">{{ $item->mode_of_payment }}</td>
                                        <td class="border  text-gray-700  px-3 py-1">
                                            {{ $item->status }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center border  text-gray-700  px-3 py-1">
                                            <span>No Data Available...</span>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">
                        <x-button label="Print Report" icon="printer" slate
                            @click="printOut($refs.printContainer.outerHTML);" />
                    </div>
                </div>
            @break

            @default
                <div class="grid place-content-center ">

                    <svg xmlns="http://www.w3.org/2000/svg" class="mt-20" data-name="Layer 1" width="430.91406"
                        height="559.70956" viewBox="0 0 430.91406 559.70956" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M689.29823,324.68445q0,4.785-.31006,9.49a143.75442,143.75442,0,0,1-13.46973,52.19c-.06006.14-.13037.27-.18994.4-.36035.76-.73047,1.52-1.11035,2.27a142.03868,142.03868,0,0,1-7.6499,13.5,144.462,144.462,0,0,1-118.56006,66.72l1.43018,82.24,18.6499-9.82,3.33008,6.33-21.83985,11.5,2.66992,152.74.02979,2.04-14.41992,1.21.02978-.05,4.54-246.18a144.17482,144.17482,0,0,1-102-44.38c-.90967-.94-1.81006-1.91-2.68994-2.87-.04-.04-.06982-.08-.1001-.11a144.76758,144.76758,0,0,1-26.33984-40.76c.14014.16.29.31.43017.47a144.642,144.642,0,0,1,68.57959-186.38c.5-.25,1.01026-.49,1.51026-.74a144.75207,144.75207,0,0,1,187.52978,56.93c.88037,1.48005,1.73047,2.99006,2.5503,4.51A143.85218,143.85218,0,0,1,689.29823,324.68445Z"
                            transform="translate(-384.54297 -170.14522)" fill="#e5e5e5" />
                        <circle cx="198.2848" cy="502.61836" r="43.06733" fill="#2f2e41" />
                        <rect x="210.6027" y="532.22265" width="38.58356" height="13.08374" fill="#2f2e41" />
                        <ellipse cx="249.45884" cy="534.4033" rx="4.08868" ry="10.90314" fill="#2f2e41" />
                        <rect x="201.6027" y="531.22265" width="38.58356" height="13.08374" fill="#2f2e41" />
                        <ellipse cx="240.45884" cy="533.4033" rx="4.08868" ry="10.90314" fill="#2f2e41" />
                        <path
                            d="M541.051,632.71229c-3.47748-15.5738,7.63866-31.31043,24.82866-35.14881s33.94421,5.67511,37.42169,21.2489-7.91492,21.31769-25.10486,25.156S544.5285,648.28608,541.051,632.71229Z"
                            transform="translate(-384.54297 -170.14522)" fill="#536dfe" />
                        <path
                            d="M599.38041,670.31119a10.75135,10.75135,0,0,1-10.33984-7.12305,1,1,0,0,1,1.896-.63672c1.51416,4.50782,6.69825,6.86524,11.55457,5.25342a9.60826,9.60826,0,0,0,5.57251-4.74756,8.23152,8.23152,0,0,0,.48547-6.33789,1,1,0,0,1,1.896-.63672,10.217,10.217,0,0,1-.59229,7.86817,11.62362,11.62362,0,0,1-6.73218,5.75244A11.87976,11.87976,0,0,1,599.38041,670.31119Z"
                            transform="translate(-384.54297 -170.14522)" fill="#fff" />
                        <path
                            d="M618.56452,676.16463a9.57244,9.57244,0,1,1-17.04506,8.71737h0l-.00855-.01674c-2.40264-4.70921.91734-7.63227,5.62657-10.03485S616.162,671.45547,618.56452,676.16463Z"
                            transform="translate(-384.54297 -170.14522)" fill="#fff" />
                        <path d="M772.27559,716.2189h-381a1,1,0,0,1,0-2h381a1,1,0,0,1,0,2Z"
                            transform="translate(-384.54297 -170.14522)" fill="#3f3d56" />
                        <ellipse cx="567.22606" cy="706.64241" rx="7.50055" ry="23.89244"
                            transform="translate(-543.03826 -6.10526) rotate(-14.4613)" fill="#2f2e41" />
                        <path
                            d="M645.50888,621.42349H629.12323a.77274.77274,0,0,1-.51881-1.3455l14.90017-13.49467h-13.7669a.77274.77274,0,0,1,0-1.54548h15.77119a.77275.77275,0,0,1,.51881,1.34551L631.12753,619.878h14.38135a.77274.77274,0,1,1,0,1.54548Z"
                            transform="translate(-384.54297 -170.14522)" fill="#cbcbcb" />
                        <path
                            d="M666.37288,597.46853H649.98723a.77275.77275,0,0,1-.51881-1.34551l14.90017-13.49466h-13.7669a.77274.77274,0,0,1,0-1.54548h15.77119a.77274.77274,0,0,1,.51881,1.3455l-14.90016,13.49467h14.38135a.77274.77274,0,1,1,0,1.54548Z"
                            transform="translate(-384.54297 -170.14522)" fill="#cbcbcb" />
                        <path
                            d="M657.1,571.19534H640.71434a.77274.77274,0,0,1-.51881-1.3455l14.90017-13.49467H641.3288a.77274.77274,0,0,1,0-1.54548H657.1a.77275.77275,0,0,1,.51881,1.34551l-14.90016,13.49466H657.1a.77274.77274,0,0,1,0,1.54548Z"
                            transform="translate(-384.54297 -170.14522)" fill="#cbcbcb" />
                        <path
                            d="M770.66217,347.522,783.457,337.28854c-9.93976-1.09662-14.0238,4.32429-15.69525,8.615-7.76532-3.22446-16.21881,1.00136-16.21881,1.00136l25.6001,9.29375A19.37209,19.37209,0,0,0,770.66217,347.522Z"
                            transform="translate(-384.54297 -170.14522)" fill="#3f3d56" />
                        <path
                            d="M403.66217,180.522,416.457,170.28854c-9.93976-1.09662-14.0238,4.32429-15.69525,8.615-7.76532-3.22446-16.21881,1.00136-16.21881,1.00136l25.6001,9.29375A19.37209,19.37209,0,0,0,403.66217,180.522Z"
                            transform="translate(-384.54297 -170.14522)" fill="#3f3d56" />
                        <path
                            d="M802.66217,215.522,815.457,205.28854c-9.93976-1.09662-14.0238,4.32429-15.69525,8.615-7.76532-3.22446-16.21881,1.00136-16.21881,1.00136l25.6001,9.29375A19.37209,19.37209,0,0,0,802.66217,215.522Z"
                            transform="translate(-384.54297 -170.14522)" fill="#3f3d56" />
                    </svg>
                </div>
        @endswitch
    </div>
</div>
