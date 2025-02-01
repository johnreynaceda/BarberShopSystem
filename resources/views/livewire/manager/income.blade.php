<div>
    <div class="bg-white p-5 mb-5 flex justify-end rounded-xl shadow">
        <div class="text-gray-700">
            <h1 class="text-right ">TOTAL INCOME</h1>
            <h1 class="text-right text-blue-800 font-bold text-4xl">&#8369;{{ number_format($incomes, 2) }}</h1>
        </div>
    </div>
    <div>
        {{ $this->table }}
    </div>
</div>
