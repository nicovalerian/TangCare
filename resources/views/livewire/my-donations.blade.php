<div>
    <!-- Navbar -->
    <livewire:navbar />

    <div class="min-h-screen bg-muted py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="bg-white rounded-lg p-8 mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-extrabold text-foreground mb-2">My Donations</h1>
                        <p class="text-gray-600">Track all your donations and their status</p>
                    </div>
                    <a href="{{ route('donations.create') }}" 
                       class="inline-flex items-center justify-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        New Donation
                    </a>
                </div>
            </div>

            <!-- Stats Summary -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">{{ $counts['all'] }}</p>
                            <p class="text-xs text-gray-600">Total</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">{{ $counts['pending'] }}</p>
                            <p class="text-xs text-gray-600">Pending</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">{{ $counts['accepted'] }}</p>
                            <p class="text-xs text-gray-600">Accepted</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-foreground">{{ $counts['received'] }}</p>
                            <p class="text-xs text-gray-600">Received</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filters & Search -->
            <div class="bg-white rounded-lg p-6 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Status Filter Tabs -->
                    <div class="flex flex-wrap gap-2">
                        <button wire:click="setFilter('all')" 
                                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $statusFilter === 'all' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            All
                            <span class="ml-1 px-2 py-0.5 rounded-full text-xs {{ $statusFilter === 'all' ? 'bg-white/20' : 'bg-gray-200' }}">{{ $counts['all'] }}</span>
                        </button>
                        <button wire:click="setFilter('pending')" 
                                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $statusFilter === 'pending' ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Pending
                            <span class="ml-1 px-2 py-0.5 rounded-full text-xs {{ $statusFilter === 'pending' ? 'bg-white/20' : 'bg-amber-100 text-amber-700' }}">{{ $counts['pending'] }}</span>
                        </button>
                        <button wire:click="setFilter('accepted')" 
                                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $statusFilter === 'accepted' ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Accepted
                            <span class="ml-1 px-2 py-0.5 rounded-full text-xs {{ $statusFilter === 'accepted' ? 'bg-white/20' : 'bg-blue-100 text-blue-700' }}">{{ $counts['accepted'] }}</span>
                        </button>
                        <button wire:click="setFilter('received')" 
                                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $statusFilter === 'received' ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Received
                            <span class="ml-1 px-2 py-0.5 rounded-full text-xs {{ $statusFilter === 'received' ? 'bg-white/20' : 'bg-green-100 text-green-700' }}">{{ $counts['received'] }}</span>
                        </button>
                        <button wire:click="setFilter('rejected')" 
                                class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ $statusFilter === 'rejected' ? 'bg-red-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            Rejected
                            <span class="ml-1 px-2 py-0.5 rounded-full text-xs {{ $statusFilter === 'rejected' ? 'bg-white/20' : 'bg-red-100 text-red-700' }}">{{ $counts['rejected'] }}</span>
                        </button>
                    </div>

                    <!-- Search -->
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search"
                               placeholder="Search donations..."
                               class="pl-10 pr-4 py-2 w-full lg:w-64 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                    </div>
                </div>
            </div>

            <!-- Donations List -->
            <div class="space-y-4">
                @forelse($donations as $donation)
                    <div class="bg-white rounded-lg p-6 hover:shadow-md transition-shadow 
                                {{ $donation->isPending() ? 'border-l-4 border-l-amber-500' : '' }}
                                {{ $donation->isAccepted() ? 'border-l-4 border-l-blue-500' : '' }}
                                {{ $donation->isReceived() ? 'border-l-4 border-l-green-500' : '' }}
                                {{ $donation->isRejected() ? 'border-l-4 border-l-red-500' : '' }}">
                        <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                            <!-- Donation Info -->
                            <div class="flex-1">
                                <div class="flex items-start gap-4">
                                    <!-- Status Icon -->
                                    <div class="hidden sm:flex w-12 h-12 rounded-lg items-center justify-center shrink-0
                                                {{ $donation->isPending() ? 'bg-amber-100' : '' }}
                                                {{ $donation->isAccepted() ? 'bg-blue-100' : '' }}
                                                {{ $donation->isReceived() ? 'bg-green-100' : '' }}
                                                {{ $donation->isRejected() ? 'bg-red-100' : '' }}">
                                        @if($donation->isPending())
                                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @elseif($donation->isAccepted())
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @elseif($donation->isReceived())
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        @elseif($donation->isRejected())
                                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                    </div>

                                    <!-- Details -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex flex-wrap items-center gap-2 mb-1">
                                            <h3 class="font-bold text-foreground truncate">
                                                {{ $donation->event->title ?? 'Unknown Event' }}
                                            </h3>
                                            <!-- Status Badge -->
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        {{ $donation->isPending() ? 'bg-amber-100 text-amber-800' : '' }}
                                                        {{ $donation->isAccepted() ? 'bg-blue-100 text-blue-800' : '' }}
                                                        {{ $donation->isReceived() ? 'bg-green-100 text-green-800' : '' }}
                                                        {{ $donation->isRejected() ? 'bg-red-100 text-red-800' : '' }}">
                                                @if($donation->isPending())
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                                                    Pending Review
                                                @elseif($donation->isAccepted())
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-1.5"></span>
                                                    Accepted
                                                @elseif($donation->isReceived())
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-1.5"></span>
                                                    Received
                                                @elseif($donation->isRejected())
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500 mr-1.5"></span>
                                                    Rejected
                                                @endif
                                            </span>
                                        </div>

                                        <p class="text-sm text-gray-600 mb-2">
                                            {{ $donation->event->yayasan->name ?? 'Unknown Foundation' }}
                                        </p>

                                        <p class="text-sm text-gray-500 line-clamp-2">
                                            {{ $donation->description }}
                                        </p>

                                        @if($donation->isRejected() && $donation->rejection_reason)
                                            <div class="mt-2 p-3 bg-red-50 rounded-lg">
                                                <p class="text-sm text-red-700">
                                                    <span class="font-medium">Reason:</span> {{ $donation->rejection_reason }}
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Meta Info -->
                            <div class="flex flex-row lg:flex-col items-center lg:items-end gap-4 lg:gap-2 text-sm text-gray-500 shrink-0">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                    <span class="font-semibold text-foreground">{{ number_format($donation->weight_kg, 1) }} kg</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $donation->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                    </svg>
                                    <span>{{ $donation->delivery_method_label }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Bar for Pending/Accepted -->
                        @if($donation->isPending() || $donation->isAccepted())
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                                    <span>Progress</span>
                                    <span>
                                        @if($donation->isPending())
                                            Step 1 of 3: Waiting for approval
                                        @elseif($donation->isAccepted())
                                            Step 2 of 3: Waiting for delivery
                                        @endif
                                    </span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-500
                                                {{ $donation->isPending() ? 'w-1/3 bg-amber-500' : '' }}
                                                {{ $donation->isAccepted() ? 'w-2/3 bg-blue-500' : '' }}">
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($donation->isReceived())
                            <div class="mt-4 pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2 text-green-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="text-sm font-medium">Donation successfully received! Thank you for your contribution.</span>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="bg-white rounded-lg p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-foreground mb-2">No donations found</h3>
                        <p class="text-gray-600 mb-6">
                            @if($statusFilter !== 'all')
                                No {{ $statusFilter }} donations found. Try a different filter.
                            @elseif($search)
                                No donations match your search "{{ $search }}".
                            @else
                                You haven't made any donations yet. Start making a difference today!
                            @endif
                        </p>
                        <a href="{{ route('donations.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary/90 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Make Your First Donation
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($donations->hasPages())
                <div class="mt-6">
                    {{ $donations->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
