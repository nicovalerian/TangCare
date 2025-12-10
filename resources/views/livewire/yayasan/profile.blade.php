<div>
    <livewire:navbar />
    
    <div class="min-h-screen bg-muted py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('yayasan.dashboard') }}" class="inline-flex items-center text-primary hover:text-blue-700 font-medium mb-4 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
                <h1 class="text-3xl font-extrabold text-foreground">Foundation Profile</h1>
                <p class="text-gray-600 mt-1">Manage your yayasan information</p>
            </div>
            
            <!-- Verification Status -->
            @if($yayasan)
                <div class="mb-6">
                    @if($yayasan->isVerified())
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-secondary/10 text-secondary rounded-lg font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Verified Foundation
                        </div>
                    @else
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-accent/10 text-accent rounded-lg font-medium">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Pending Verification
                        </div>
                    @endif
                </div>
            @endif
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 px-4 py-3 bg-secondary/10 border-2 border-secondary text-secondary rounded-lg font-medium">
                    {{ session('success') }}
                </div>
            @endif
            
            <!-- Form -->
            <form wire:submit="save" class="bg-white rounded-lg p-6 sm:p-8 space-y-6">
                <!-- Foundation Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-foreground mb-2">Foundation Name *</label>
                    <input 
                        wire:model="name" 
                        type="text" 
                        id="name" 
                        class="w-full px-4 py-3 bg-muted rounded-md text-foreground placeholder-gray-500 border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all duration-200"
                        placeholder="e.g., Yayasan Peduli Tangerang"
                    >
                    @error('name')
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
                        placeholder="Tell donors about your foundation's mission and activities..."
                    ></textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-semibold text-foreground mb-2">Address *</label>
                    <textarea 
                        wire:model="address" 
                        id="address" 
                        rows="2"
                        class="w-full px-4 py-3 bg-muted rounded-md text-foreground placeholder-gray-500 border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all duration-200 resize-none"
                        placeholder="Full address in Tangerang area"
                    ></textarea>
                    @error('address')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Coordinates -->
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="latitude" class="block text-sm font-semibold text-foreground mb-2">Latitude</label>
                        <input 
                            wire:model="latitude" 
                            type="number" 
                            step="any"
                            id="latitude" 
                            class="w-full px-4 py-3 bg-muted rounded-md text-foreground placeholder-gray-500 border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all duration-200"
                            placeholder="-6.1781"
                        >
                        @error('latitude')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="longitude" class="block text-sm font-semibold text-foreground mb-2">Longitude</label>
                        <input 
                            wire:model="longitude" 
                            type="number" 
                            step="any"
                            id="longitude" 
                            class="w-full px-4 py-3 bg-muted rounded-md text-foreground placeholder-gray-500 border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all duration-200"
                            placeholder="106.6319"
                        >
                        @error('longitude')
                            <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <p class="text-sm text-gray-500">Coordinates help donors find your location on the map. You can get these from Google Maps.</p>
                
                <!-- Submit Button -->
                <div class="pt-4">
                    <button 
                        type="submit" 
                        class="btn-primary"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-75 cursor-wait"
                    >
                        <span wire:loading.remove>Save Profile</span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Saving...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
