<div>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <div class="2xl:p-5 p-2 bg-white">
        <div x-data="mapComponent()" x-init="init()">
            <!-- Barbershop buttons -->
            <div class=" hidden 2xl:block mb-3">
                <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" slides-per-view="5"
                    space-between="5" free-mode="true">

                    @foreach ($markers as $item)
                        <swiper-slide>
                            <button
                                @click="centerOnMarker({{ $item->latitude }}, {{ $item->longitude }}); selectShop({{ $item->id }})"
                                class="p-2 border px-4 rounded-2xl font-semibold flex space-x-2 hover:bg-main hover:text-white hover:scale-95 transition duration-150">

                                <span>{{ $item->name }}</span>

                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-square-scissors">
                                    <rect width="20" height="20" x="2" y="2" rx="2" />
                                    <circle cx="8" cy="8" r="2" />
                                    <path d="M9.414 9.414 12 12" />
                                    <path d="M14.8 14.8 18 18" />
                                    <circle cx="8" cy="16" r="2" />
                                    <path d="m18 6-8.586 8.586" />
                                </svg>

                            </button>
                        </swiper-slide>
                    @endforeach
                </swiper-container>
            </div>
            <div class=" 2xl:hidden  mb-3">
                <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" slides-per-view="3"
                    space-between="2" free-mode="true">

                    @foreach ($markers as $item)
                        <swiper-slide>
                            <button
                                @click="centerOnMarker({{ $item->latitude }}, {{ $item->longitude }}); selectShop({{ $item->id }})"
                                class="p-2 border px-4 text-sm uppercase rounded-2xl font-semibold flex space-x-2 hover:bg-main hover:text-white hover:scale-95 transition duration-150">
                                <span>{{ $item->name }}</span>
                            </button>
                        </swiper-slide>
                    @endforeach
                </swiper-container>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

            <!-- Map container -->
            <div id="map" style="width: 100%; height: 400px;"></div>
        </div>
    </div>

    <script>
        function mapComponent() {
            return {
                map: null,
                scissorIcon: null,
                markers: @json($markers), // Initial markers from Livewire
                selectedShop: null, // To track the currently selected shop
                init() {
                    // Check if there are any markers available
                    if (this.markers.length === 0) {
                        console.error("No markers available.");
                        return;
                    }

                    // Initialize Leaflet map with the first marker's coordinates
                    const firstMarker = this.markers[0];
                    this.map = L.map('map').setView([firstMarker.latitude, firstMarker.longitude], 13);

                    // Add the tile layer
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(this.map);

                    // Define custom scissor icon
                    this.scissorIcon = L.icon({
                        iconUrl: '{{ asset('images/marker.png') }}',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });

                    // Place initial markers on the map
                    this.updateMarkers(this.markers);
                },
                updateMarkers(markers) {
                    // Clear existing markers
                    this.map.eachLayer(layer => {
                        if (layer instanceof L.Marker) {
                            this.map.removeLayer(layer);
                        }
                    });

                    // Add new markers
                    markers.forEach(marker => {
                        L.marker([marker.latitude, marker.longitude], {
                                icon: this.scissorIcon
                            })
                            .addTo(this.map)
                            .bindPopup(marker.name);
                    });
                },
                centerOnMarker(lat, lng) {
                    // Center map on the specified marker's coordinates
                    this.map.setView([lat, lng], 13);
                },
                selectShop(id) {
                    // Set the selected shop ID
                    this.selectedShop = id;
                }
            };
        }
    </script>






</div>
