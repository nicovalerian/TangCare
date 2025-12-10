<div>
    <livewire:navbar />
    
    <div class="min-h-screen bg-muted py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <div>
                    <a href="{{ route('yayasan.dashboard') }}" class="inline-flex items-center text-primary hover:text-blue-700 font-medium mb-2 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Dashboard
                    </a>
                    <h1 class="text-3xl font-extrabold text-foreground">My Events</h1>
                    <p class="text-gray-600 mt-1">Manage your charity events</p>
                </div>
                <a href="{{ route('yayasan.events.create') }}" class="btn-primary inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    New Event
                </a>
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
                        placeholder="Search events..."
                        class="w-full px-4 py-2 bg-muted rounded-md text-foreground border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all"
                    >
                </div>
                <select 
                    wire:model.live="status"
                    class="px-4 py-2 bg-muted rounded-md text-foreground border-2 border-transparent focus:border-primary focus:outline-none transition-all"
                >
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            
            <!-- Events List -->
            @if($events->count() > 0)
                <div class="bg-white rounded-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-muted">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-foreground">Event</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-foreground">Dates</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-foreground">Donations</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-foreground">Status</th>
                                    <th class="px-6 py-4 text-right text-sm font-semibold text-foreground">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($events as $event)
                                    <tr class="hover:bg-muted/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-foreground">{{ $event->title }}</div>
                                            <div class="text-sm text-gray-500 truncate max-w-xs">{{ Str::limit($event->description, 60) }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            @if($event->start_date)
                                                {{ $event->start_date->format('M d, Y') }}
                                            @else
                                                <span class="text-gray-400">No start date</span>
                                            @endif
                                            @if($event->end_date)
                                                <br><span class="text-gray-400">→</span> {{ $event->end_date->format('M d, Y') }}
                                            @else
                                                <br><span class="text-secondary font-medium">Ongoing</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center justify-center w-8 h-8 bg-primary/10 text-primary font-bold rounded-full">
                                                {{ $event->donations_count }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            @if($event->is_active)
                                                <span class="inline-block px-3 py-1 bg-secondary/10 text-secondary text-sm font-semibold rounded-full">Active</span>
                                            @else
                                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-500 text-sm font-semibold rounded-full">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a 
                                                    href="{{ route('yayasan.events.edit', $event) }}"
                                                    class="p-2 text-gray-500 hover:text-primary hover:bg-primary/10 rounded-md transition-all"
                                                    title="Edit"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                                <button 
                                                    wire:click="toggleActive({{ $event->id }})"
                                                    class="p-2 text-gray-500 hover:text-accent hover:bg-accent/10 rounded-md transition-all"
                                                    title="{{ $event->is_active ? 'Deactivate' : 'Activate' }}"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        @if($event->is_active)
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        @else
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        @endif
                                                    </svg>
                                                </button>
                                                <button 
                                                    wire:click="deleteEvent({{ $event->id }})"
                                                    wire:confirm="Are you sure you want to delete this event?"
                                                    class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-all"
                                                    title="Delete"
                                                >
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if($events->hasPages())
                        <div class="px-6 py-4 border-t border-gray-100">
                            {{ $events->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-white rounded-lg p-12 text-center">
                    <div class="w-16 h-16 bg-muted rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-2">No Events Yet</h3>
                    <p class="text-gray-600 mb-6">Create your first event to start receiving donations.</p>
                    <a href="{{ route('yayasan.events.create') }}" class="btn-primary inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Event
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
