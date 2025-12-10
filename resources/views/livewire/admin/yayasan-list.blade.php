<div>
    <livewire:navbar />
    
    <div class="min-h-screen bg-muted py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-primary hover:text-blue-700 font-medium mb-2 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Dashboard
                    </a>
                    <h1 class="text-3xl font-extrabold text-foreground">Manage Yayasans</h1>
                    <p class="text-gray-600 mt-1">Verify and manage foundation accounts</p>
                </div>
                @if($pendingCount > 0)
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-accent/10 text-accent rounded-lg font-medium">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $pendingCount }} Pending Verification
                    </div>
                @endif
            </div>
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-secondary/10 border-2 border-secondary text-secondary rounded-lg font-medium">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Filters -->
            <div class="bg-white rounded-lg p-4 mb-6 flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input 
                        wire:model.live.debounce.300ms="search"
                        type="text"
                        placeholder="Search by name or address..."
                        class="w-full px-4 py-2 bg-muted rounded-md text-foreground border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all"
                    >
                </div>
                <select 
                    wire:model.live="status"
                    class="px-4 py-2 bg-muted rounded-md text-foreground border-2 border-transparent focus:border-primary focus:outline-none transition-all"
                >
                    <option value="all">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="verified">Verified</option>
                </select>
            </div>
            
            <!-- Yayasans List -->
            @if($yayasans->count() > 0)
                <div class="bg-white rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-muted">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-foreground">Foundation</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-foreground">Representative</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-foreground">Events</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-foreground">Status</th>
                                    <th class="px-6 py-4 text-right text-sm font-semibold text-foreground">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($yayasans as $yayasan)
                                    <tr class="hover:bg-muted/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-foreground">{{ $yayasan->name }}</div>
                                            <div class="text-sm text-gray-500 truncate max-w-xs">{{ Str::limit($yayasan->address, 50) }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-foreground">{{ $yayasan->user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $yayasan->user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 bg-primary/10 text-primary font-bold rounded-full">
                                                {{ $yayasan->events_count }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($yayasan->isVerified())
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-secondary/10 text-secondary text-sm font-semibold rounded-full">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    Verified
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-3 py-1 bg-accent/10 text-accent text-sm font-semibold rounded-full">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if($yayasan->isVerified())
                                                <button 
                                                    wire:click="unverify({{ $yayasan->id }})"
                                                    wire:confirm="Are you sure you want to revoke verification for this yayasan?"
                                                    class="px-4 py-2 text-sm font-medium text-red-600 hover:text-white hover:bg-red-600 border-2 border-red-600 rounded-md transition-all"
                                                >
                                                    Revoke
                                                </button>
                                            @else
                                                <button 
                                                    wire:click="verify({{ $yayasan->id }})"
                                                    class="px-4 py-2 text-sm font-medium text-white bg-secondary hover:bg-emerald-600 rounded-md transition-all"
                                                >
                                                    Verify
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($yayasans->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $yayasans->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-white rounded-lg p-12 text-center">
                    <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-2">No Yayasans Found</h3>
                    <p class="text-gray-600">No foundations match your search criteria.</p>
                </div>
            @endif
        </div>
    </div>
</div>
