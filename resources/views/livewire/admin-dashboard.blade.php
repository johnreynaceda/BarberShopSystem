<div>
    <div class="mt-10 grid grid-cols-6 gap-5">

        <div class="col-span-4">
            <div class="bg-white rounded-xl p-5">
                <h1 class="mb-5 font-semibold text-gray-600">TOP BARBERSHOPS</h1>
                <canvas wire:ignore id="myChart"></canvas>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ctx = document.getElementById('myChart');

                        // Prepare the data for the chart
                        const labels = @json(array_column($barbershops, 'barber_name')); // Extract barber names
                        const data = @json(array_column($barbershops, 'count')); // Extract count data

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Barbershops',
                                    data: data,
                                    borderWidth: 1,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                </script>
            </div>
            <div class="bg-white rounded-xl mt-10 p-5">
                <h1 class="mb-5 font-semibold text-gray-600">BARBERSHOPS INCOME</h1>

                <!-- Dropdown for selecting filter -->
                <div class="mb-5 w-48">
                    {{-- <label for="filter" class="block text-gray-700 font-medium">Filter By:</label>
                    <select id="filter" wire:model.live="incomeFilter" class="mt-1 block w-1/4 p-2 border rounded">
                        <option value="">All</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select> --}}
                    <x-native-select label="Filter by:" wire:model.live="incomeFilter">
                        <option value="">All</option>
                        <option value="daily">Daily</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </x-native-select>
                </div>

                <!-- Chart -->
                <canvas wire:ignore id="myChart1"></canvas>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ctx1 = document.getElementById('myChart1');
                        let myChart1 = null;

                        // Function to update the chart
                        function updateChart(labels, data) {
                            console.log(labels);
                            if (myChart1) {
                                myChart1.destroy(); // Destroy the old chart
                            }

                            myChart1 = new Chart(ctx1, {
                                type: 'bar',
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: 'Barbershops',
                                        data: data,
                                        borderWidth: 1,

                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        }

                        // Initial Chart Rendering
                        const initialLabels = @json(array_column($incomes, 'name'));
                        const initialData = @json(array_column($incomes, 'total_income'));
                        updateChart(initialLabels, initialData);

                        // Listen for Livewire updates
                        Livewire.on('updateChart', (eventData) => {
                            updateChart(eventData[0][0], eventData[0][1]);
                            console.log('chart updated');
                            console.log();
                        });
                    });
                </script>

            </div>



        </div>
        <div class="col-span-2">
            <div class="bg-white rounded-xl p-5">
                <h1 class="mb-5 font-semibold text-gray-600">TOP SERVICES</h1>
                <canvas wire:ignore id="serviceChart1"></canvas>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const ctx1 = document.getElementById('serviceChart1');

                        // Prepare the data for the chart
                        const labels = @json(array_column($services, 'service_name')); // Extract service names
                        const data = @json(array_column($services, 'count')); // Extract count data

                        new Chart(ctx1, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Services',
                                    data: data,
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    });
                </script>

            </div>
        </div>


    </div>
</div>
</div>
