<div>
    <livewire:navbar />
    
    <div class="min-h-screen bg-muted">
        <!-- Header -->
        <div class="bg-primary py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-extrabold text-white mb-2">Find Donation Events</h1>
                <p class="text-white/80">Discover nearby events and make a difference in Tangerang</p>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="bg-white border-b-2 border-gray-100 py-4 sticky top-16 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row gap-4 items-center">
                    <div class="flex-1 w-full">
                        <input 
                            wire:model.live.debounce.300ms="search"
                            type="text"
                            placeholder="Search events, yayasans, or locations..."
                            class="w-full px-4 py-2 bg-muted rounded-md text-foreground border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all"
                        >
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer whitespace-nowrap">
                        <input 
                            wire:model.live="onlyOngoing"
                            type="checkbox"
                            class="w-5 h-5 rounded border-2 border-gray-300 text-primary focus:ring-2 focus:ring-primary"
                        >
                        <span class="font-medium text-foreground">Ongoing only</span>
                    </label>
                    <div class="text-sm text-gray-500">
                        {{ count($events) }} event{{ count($events) !== 1 ? 's' : '' }} found
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Map & List Container -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Map -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg overflow-hidden" style="height: 500px;">
                        <div 
                            id="events-map" 
                            class="w-full h-full"
                            wire:ignore
                        ></div>
                    </div>
                </div>
                
                <!-- Events List -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg overflow-hidden">
                        <div class="px-4 py-3 bg-muted border-b-2 border-gray-100">
                            <h2 class="font-bold text-foreground">Events List</h2>
                        </div>
                        <div class="max-h-[440px] overflow-y-auto divide-y divide-gray-100">
                            @forelse($events as $event)
                                <div 
                                    class="p-4 hover:bg-muted/50 transition-colors"
                                >
                                    <div class="flex items-start gap-3 cursor-pointer" onclick="focusMarker({{ $event->id }})">
                                        <div class="w-10 h-10 flex-shrink-0 bg-primary/10 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="font-semibold text-foreground truncate">{{ $event->title }}</p>
                                            <p class="text-sm text-gray-500 truncate">{{ $event->yayasan->name }}</p>
                                            <div class="mt-1">
                                                @if($event->isOngoing())
                                                    <span class="inline-block px-2 py-0.5 bg-secondary/10 text-secondary text-xs font-semibold rounded-full">Ongoing</span>
                                                @elseif($event->end_date)
                                                    <span class="inline-block px-2 py-0.5 bg-accent/10 text-accent text-xs font-semibold rounded-full">
                                                        Until {{ $event->end_date->format('M d') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @auth
                                        @if(auth()->user()->isDonor())
                                            <a href="{{ route('donations.create', ['event' => $event->id]) }}" class="mt-3 block w-full py-2 px-3 text-center text-sm font-medium text-primary bg-primary/10 rounded-md hover:bg-primary hover:text-white transition-colors">
                                                Donate to this Event
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}" class="mt-3 block w-full py-2 px-3 text-center text-sm font-medium text-gray-600 bg-muted rounded-md hover:bg-gray-200 transition-colors">
                                            Login to Donate
                                        </a>
                                    @endauth
                                </div>
                            @empty
                                <div class="p-8 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                    </svg>
                                    <p class="font-medium">No events found</p>
                                    <p class="text-sm">Try adjusting your search filters</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Leaflet CSS -->
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
        .leaflet-popup-content-wrapper {
            border-radius: 8px;
            box-shadow: none;
            border: 2px solid #E5E7EB;
        }
        .leaflet-popup-content {
            margin: 12px 16px;
            font-family: 'Outfit', sans-serif;
        }
        .custom-marker {
            background: #3B82F6;
            border: 3px solid white;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }
    </style>
    @endpush
    
    <!-- Leaflet JS -->
    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        let map;
        let markers = {};
        let markersData = @json($mapData);
        
        // Initialize map
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
        });
        
        function initMap() {
            // Center on Tangerang area
            const tangerang = [-6.1781, 106.6319];
            
            map = L.map('events-map').setView(tangerang, 12);
            
            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            
            // Add markers
            updateMarkers(markersData);
        }
        
        function updateMarkers(data) {
            // Clear existing markers
            Object.values(markers).forEach(m => map.removeLayer(m));
            markers = {};
            
            if (data.length === 0) return;
            
            const bounds = [];
            
            data.forEach(event => {
                const icon = L.divIcon({
                    className: 'custom-marker',
                    iconSize: [24, 24],
                    iconAnchor: [12, 12],
                    popupAnchor: [0, -12]
                });
                
                const marker = L.marker([event.lat, event.lng], { icon })
                    .addTo(map)
                    .bindPopup(createPopupContent(event));
                
                markers[event.id] = marker;
                bounds.push([event.lat, event.lng]);
            });
            
            // Fit bounds if there are markers
            if (bounds.length > 0) {
                map.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
            }
        }
        
        function createPopupContent(event) {
            let dateInfo = '';
            if (event.isOngoing) {
                dateInfo = '<span class="inline-block px-2 py-0.5 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Ongoing</span>';
            } else if (event.endDate) {
                dateInfo = `<span class="text-sm text-gray-500">${event.startDate || ''} - ${event.endDate}</span>`;
            }
            
            return `
                <div class="min-w-[200px]">
                    <h3 class="font-bold text-foreground mb-1">${event.title}</h3>
                    <p class="text-sm text-primary font-medium mb-1">${event.yayasan}</p>
                    <p class="text-xs text-gray-500 mb-2">${event.address}</p>
                    ${event.description ? `<p class="text-sm text-gray-600 mb-2">${event.description}</p>` : ''}
                    ${dateInfo}
                </div>
            `;
        }
        
        function focusMarker(eventId) {
            const marker = markers[eventId];
            if (marker) {
                map.setView(marker.getLatLng(), 15);
                marker.openPopup();
            }
        }
        
        // Listen for Livewire updates
        document.addEventListener('livewire:navigated', function() {
            if (typeof map !== 'undefined') {
                map.invalidateSize();
            }
        });
        
        // Update markers when Livewire updates
        Livewire.on('markersUpdated', (data) => {
            updateMarkers(data[0]);
        });
    </script>
    @endpush
</div>
