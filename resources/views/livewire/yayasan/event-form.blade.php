<div>
    <livewire:navbar />
    
    <div class="min-h-screen bg-muted py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('yayasan.events') }}" class="inline-flex items-center text-primary hover:text-blue-700 font-medium mb-4 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Events
                </a>
                <h1 class="text-3xl font-extrabold text-foreground">
                    {{ $isEditing ? 'Edit Event' : 'Create New Event' }}
                </h1>
                <p class="text-gray-600 mt-1">
                    {{ $isEditing ? 'Update your event details' : 'Set up a new donation event for donors' }}
                </p>
            </div>
            
            <!-- Form -->
            <form wire:submit="save" class="bg-white rounded-lg p-6 sm:p-8 space-y-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-semibold text-foreground mb-2">Event Title *</label>
                    <input 
                        wire:model="title" 
                        type="text" 
                        id="title" 
                        class="w-full px-4 py-3 bg-muted rounded-md text-foreground placeholder-gray-500 border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all duration-200"
                        placeholder="e.g., Monthly Food Drive - December 2024"
                    >
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-semibold text-foreground mb-2">Description</label>
                    <textarea 
                        wire:model="description" 
                        id="description" 
                        rows="4"
                        class="w-full px-4 py-3 bg-muted rounded-md text-foreground placeholder-gray-500 border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all duration-200 resize-none"
                        placeholder="Describe what donations you're accepting, who you're helping, and any special instructions..."
                    ></textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Dates -->
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-semibold text-foreground mb-2">Start Date</label>
                        <input 
                            wire:model="start_date" 
                            type="date" 
                            id="start_date" 
                            class="w-full px-4 py-3 bg-muted rounded-md text-foreground border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all duration-200"
                        >
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-semibold text-foreground mb-2">End Date</label>
                        <input 
                            wire:model="end_date" 
                            type="date" 
                            id="end_date" 
                            class="w-full px-4 py-3 bg-muted rounded-md text-foreground border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all duration-200"
                        >
                        <p class="mt-1 text-sm text-gray-500">Leave empty for ongoing events</p>
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Active Toggle -->
                <div>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input 
                            wire:model="is_active" 
                            type="checkbox" 
                            class="w-5 h-5 rounded border-2 border-gray-300 text-primary focus:ring-2 focus:ring-primary focus:ring-offset-2"
                        >
                        <div>
                            <span class="font-semibold text-foreground">Active Event</span>
                            <p class="text-sm text-gray-500">Only active events are visible to donors</p>
                        </div>
                    </label>
                </div>
                
                <!-- Submit Buttons -->
                <div class="flex items-center gap-4 pt-4">
                    <button 
                        type="submit" 
                        class="btn-primary"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-75 cursor-wait"
                    >
                        <span wire:loading.remove>{{ $isEditing ? 'Update Event' : 'Create Event' }}</span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Saving...
                        </span>
                    </button>
                    <a href="{{ route('yayasan.events') }}" class="btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
