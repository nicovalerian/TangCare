<div>
    <livewire:navbar />

    <div class="min-h-screen bg-muted py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="bg-gray-900 rounded-lg p-8 mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <span class="inline-block px-3 py-1 bg-primary text-white text-sm font-semibold rounded-full mb-3 uppercase tracking-wider">Admin</span>
                        <h1 class="text-3xl font-extrabold text-white mb-2">
                            Admin Dashboard
                        </h1>
                        <p class="text-gray-400">
                            Platform overview and analytics
                        </p>
                    </div>
                    <div class="hidden sm:block">
                        <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-2xl font-bold text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pending Yayasans Alert -->
            @if($stats['pendingYayasans'] > 0)
                <a href="{{ route('admin.yayasans') }}?status=pending" class="block bg-accent/10 border-2 border-accent rounded-lg p-4 mb-8 hover:bg-accent/20 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-accent rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-foreground">{{ $stats['pendingYayasans'] }} Yayasan{{ $stats['pendingYayasans'] > 1 ? 's' : '' }} Pending Verification</p>
                            <p class="text-sm text-gray-600">Click to review and verify foundation accounts</p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
            @endif
            
            <!-- Quick Actions -->
            <div class="grid md:grid-cols-2 gap-4 mb-8">
                <a href="{{ route('admin.yayasans') }}" class="bg-white rounded-lg p-6 flex items-center gap-4 hover:scale-[1.02] transition-transform">
                    <div class="w-12 h-12 bg-secondary/10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-secondary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-foreground">Manage Yayasans</h3>
                        <p class="text-sm text-gray-500">Verify and manage foundations</p>
                    </div>
                </a>
                <a href="{{ route('events.map') }}" class="bg-white rounded-lg p-6 flex items-center gap-4 hover:scale-[1.02] transition-transform">
                    <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-foreground">View Events Map</h3>
                        <p class="text-sm text-gray-500">See all active donation events</p>
                    </div>
                </a>
            </div>
            
            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-foreground">{{ $stats['totalUsers'] }}</p>
                            <p class="text-xs text-gray-500">Total Users</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-secondary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-secondary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-foreground">{{ $stats['verifiedYayasans'] }}<span class="text-sm text-gray-400">/{{ $stats['totalYayasans'] }}</span></p>
                            <p class="text-xs text-gray-500">Verified Yayasans</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-accent/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-accent" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-foreground">{{ $stats['activeEvents'] }}<span class="text-sm text-gray-400">/{{ $stats['totalEvents'] }}</span></p>
                            <p class="text-xs text-gray-500">Active Events</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-foreground">{{ $stats['totalDonations'] }}</p>
                            <p class="text-xs text-gray-500">Total Donations</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Total Impact Banner -->
            <div class="bg-gradient-to-r from-primary to-blue-600 rounded-lg p-8 mb-8 text-center">
                <p class="text-white/80 text-sm uppercase tracking-wider mb-2">Total Impact</p>
                <p class="text-5xl font-extrabold text-white mb-2">{{ number_format($stats['totalKgDonated'], 1) }} kg</p>
                <p class="text-white/70">of donations received by foundations</p>
            </div>
            
            <!-- Charts Section -->
            <div class="grid lg:grid-cols-2 gap-6 mb-8">
                <!-- Donations Over Time Chart -->
                <div class="bg-white rounded-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="font-bold text-foreground">Donations Over Time</h3>
                        <select 
                            wire:model.live="chartPeriod"
                            class="px-3 py-1.5 bg-muted rounded-md text-sm font-medium border-0 focus:ring-2 focus:ring-primary"
                        >
                            <option value="week">Last 7 days</option>
                            <option value="month">Last 30 days</option>
                            <option value="year">Last 12 months</option>
                        </select>
                    </div>
                    <div class="h-64" wire:ignore>
                        <canvas id="donationsChart"></canvas>
                    </div>
                </div>
                
                <!-- Donation Status Donut -->
                <div class="bg-white rounded-lg p-6">
                    <h3 class="font-bold text-foreground mb-6">Donation Status Breakdown</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="h-48" wire:ignore>
                            <canvas id="statusChart"></canvas>
                        </div>
                        <div class="flex flex-col justify-center space-y-3">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-amber-500"></div>
                                <span class="text-sm text-gray-600">Pending</span>
                                <span class="ml-auto font-bold">{{ $statusBreakdown['pending'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-primary"></div>
                                <span class="text-sm text-gray-600">Accepted</span>
                                <span class="ml-auto font-bold">{{ $statusBreakdown['accepted'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-secondary"></div>
                                <span class="text-sm text-gray-600">Received</span>
                                <span class="ml-auto font-bold">{{ $statusBreakdown['received'] }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <span class="text-sm text-gray-600">Rejected</span>
                                <span class="ml-auto font-bold">{{ $statusBreakdown['rejected'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Top Yayasans -->
            <div class="bg-white rounded-lg p-6">
                <h3 class="font-bold text-foreground mb-6">Top Yayasans by Donations Received</h3>
                @if(count($topYayasans) > 0)
                    <div class="space-y-4">
                        @foreach($topYayasans as $index => $yayasan)
                            <div class="flex items-center gap-4">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm
                                    {{ $index === 0 ? 'bg-amber-100 text-amber-600' : 
                                       ($index === 1 ? 'bg-gray-200 text-gray-600' : 
                                       ($index === 2 ? 'bg-orange-100 text-orange-600' : 'bg-muted text-gray-500')) }}">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-semibold text-foreground truncate">{{ $yayasan['name'] }}</p>
                                    <p class="text-xs text-gray-500">{{ $yayasan['events_count'] }} event{{ $yayasan['events_count'] !== 1 ? 's' : '' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-primary">{{ number_format($yayasan['total_kg'], 1) }} kg</p>
                                    <p class="text-xs text-gray-500">received</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No donation data yet</p>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chartData = @json($chartData);
        const statusData = @json($statusBreakdown);
        
        // Line Chart - Donations Over Time
        const donationsCtx = document.getElementById('donationsChart').getContext('2d');
        const donationsChart = new Chart(donationsCtx, {
            type: 'line',
            data: {
                labels: chartData.labels,
                datasets: [
                    {
                        label: 'Donations',
                        data: chartData.counts,
                        borderColor: '#2563EB',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#2563EB',
                    },
                    {
                        label: 'Total Kg',
                        data: chartData.kgs,
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#10B981',
                        yAxisID: 'y1',
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Count'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Kg'
                        },
                        grid: {
                            drawOnChartArea: false,
                        },
                    }
                }
            }
        });
        
        // Donut Chart - Status Breakdown
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        const statusChart = new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Accepted', 'Received', 'Rejected'],
                datasets: [{
                    data: [statusData.pending, statusData.accepted, statusData.received, statusData.rejected],
                    backgroundColor: ['#F59E0B', '#2563EB', '#10B981', '#EF4444'],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '65%'
            }
        });
        
        // Listen for Livewire updates
        Livewire.on('chartDataUpdated', (data) => {
            donationsChart.data.labels = data[0].labels;
            donationsChart.data.datasets[0].data = data[0].counts;
            donationsChart.data.datasets[1].data = data[0].kgs;
            donationsChart.update();
        });
    });
</script>
@endpush
