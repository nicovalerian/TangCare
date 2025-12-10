<div 
    class="relative"
    wire:poll.10s
    x-data="{ open: @entangle('isOpen') }"
    @click.outside="open = false; $wire.closeDropdown()"
>
    <!-- Bell Button -->
    <button 
        @click="open = !open; $wire.toggleDropdown()"
        class="relative p-2 text-gray-600 hover:text-primary transition-colors rounded-lg hover:bg-muted"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        
        <!-- Unread Badge -->
        @if($this->unreadCount > 0)
            <span class="absolute top-0 right-0 w-5 h-5 bg-accent text-white text-xs font-bold rounded-full flex items-center justify-center transform translate-x-1 -translate-y-1">
                {{ $this->unreadCount > 9 ? '9+' : $this->unreadCount }}
            </span>
        @endif
    </button>
    
    <!-- Dropdown -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-80 bg-white rounded-lg border-2 border-gray-100 shadow-lg z-50"
        style="display: none;"
    >
        <!-- Header -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-100">
            <h3 class="font-bold text-foreground">Notifications</h3>
            @if($this->unreadCount > 0)
                <button 
                    wire:click="markAllAsRead"
                    class="text-xs text-primary hover:text-blue-700 font-medium"
                >
                    Mark all read
                </button>
            @endif
        </div>
        
        <!-- Notifications List -->
        <div class="max-h-80 overflow-y-auto">
            @forelse($this->notifications as $notification)
                <div 
                    class="px-4 py-3 border-b border-gray-50 hover:bg-muted/50 transition-colors cursor-pointer {{ !$notification->is_read ? 'bg-primary/5' : '' }}"
                    wire:click="markAsRead({{ $notification->id }})"
                >
                    <div class="flex items-start gap-3">
                        <!-- Icon -->
                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 {{ !$notification->is_read ? 'bg-primary' : 'bg-muted' }}">
                            @if(str_contains($notification->title, 'Accepted') || str_contains($notification->title, 'Received'))
                                <svg class="w-4 h-4 {{ !$notification->is_read ? 'text-white' : 'text-secondary' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            @elseif(str_contains($notification->title, 'Declined') || str_contains($notification->title, 'Rejected'))
                                <svg class="w-4 h-4 {{ !$notification->is_read ? 'text-white' : 'text-red-500' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            @else
                                <svg class="w-4 h-4 {{ !$notification->is_read ? 'text-white' : 'text-gray-500' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <p class="font-semibold text-sm text-foreground {{ !$notification->is_read ? '' : 'text-gray-600' }}">
                                {{ $notification->title }}
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5 line-clamp-2">
                                {{ $notification->body }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                        
                        <!-- Unread Indicator -->
                        @if(!$notification->is_read)
                            <div class="w-2 h-2 bg-primary rounded-full flex-shrink-0 mt-2"></div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="px-4 py-8 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <p class="text-sm text-gray-500">No notifications yet</p>
                    <p class="text-xs text-gray-400 mt-1">We'll let you know when something happens</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
