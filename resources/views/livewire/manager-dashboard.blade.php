<div>
    <div>
        <div class="bg-white p-5 rounded-xl">
            <h1 class="mb-5 font-semibold text-xl text-gray-600">BARBERS INCOME</h1>
            <div class="w-40">
                <x-native-select label="Generate As" wire:model.live="filter">
                    <option value="">All</option>
                    <option value="Daily">Daily</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
                </x-native-select>
            </div>
            <div>
                <canvas wire:ignore id="myChart"></canvas>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ctx = document.getElementById('myChart');
                    let myChart = null;

                    // Function to update the chart
                    function updateChart(labels, data) {
                        if (myChart) {
                            myChart.destroy(); // Destroy the old chart
                        }

                        myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Barber Income',
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
                    const initialLabels = @json(array_column($income, 'barber_name'));
                    const initialData = @json(array_column($income, 'total_commission'));
                    updateChart(initialLabels, initialData);

                    // Listen for Livewire updates
                    Livewire.on('updateChart', (eventData) => {
                        updateChart(eventData[0][0], eventData[0][1]);
                        console.log('chart updated');
                        console.log(eventData[0][0]);
                    });
                });
            </script>

        </div>
    </div>
</div>
