<div>
    <livewire:navbar />
    
    <div class="min-h-screen bg-muted py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 text-center">
                <h1 class="text-3xl font-extrabold text-foreground mb-2">Make a Donation</h1>
                <p class="text-gray-600">Help make a difference in Tangerang</p>
            </div>
            
            <!-- Step Indicator -->
            <div class="mb-8">
                <div class="flex items-center justify-center">
                    @foreach([1 => 'Select Event', 2 => 'Details', 3 => 'Delivery'] as $num => $label)
                        <div class="flex items-center">
                            <button 
                                wire:click="goToStep({{ $num }})"
                                class="flex items-center gap-2 {{ $num <= $step ? 'cursor-pointer' : 'cursor-not-allowed' }}"
                                @if($num > $step) disabled @endif
                            >
                                <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold transition-all
                                    {{ $step === $num ? 'bg-primary text-white scale-110' : 
                                       ($step > $num ? 'bg-secondary text-white' : 'bg-gray-300 text-gray-600') }}
                                ">
                                    @if($step > $num)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @else
                                        {{ $num }}
                                    @endif
                                </div>
                                <span class="hidden sm:block text-sm font-medium {{ $step === $num ? 'text-primary' : 'text-gray-500' }}">
                                    {{ $label }}
                                </span>
                            </button>
                            @if($num < 3)
                                <div class="w-12 h-1 mx-2 rounded {{ $step > $num ? 'bg-secondary' : 'bg-gray-300' }}"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Form Card -->
            <div class="bg-white rounded-lg p-6 sm:p-8">
                <!-- Step 1: Event Selection -->
                @if($step === 1)
                    <div>
                        <h2 class="text-xl font-bold text-foreground mb-4">Select an Event</h2>
                        <p class="text-gray-600 mb-6">Choose the event you'd like to donate to</p>
                        
                        @if($selectedEvent)
                            <div class="mb-6 p-4 bg-primary/5 border-2 border-primary rounded-lg">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="font-bold text-foreground">{{ $selectedEvent->title }}</p>
                                        <p class="text-sm text-primary font-medium">{{ $selectedEvent->yayasan->name }}</p>
                                        <p class="text-sm text-gray-500">{{ $selectedEvent->yayasan->address }}</p>
                                    </div>
                                    <button wire:click="$set('selectedEvent', null); $set('eventId', null)" class="text-gray-400 hover:text-gray-600">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif
                        
                        <div class="space-y-3 max-h-[400px] overflow-y-auto">
                            @forelse($availableEvents as $event)
                                <button 
                                    wire:click="selectEvent({{ $event->id }})"
                                    class="w-full text-left p-4 rounded-lg border-2 transition-all
                                        {{ $eventId === $event->id ? 'border-primary bg-primary/5' : 'border-gray-200 hover:border-gray-300 hover:bg-muted' }}"
                                >
                                    <div class="flex items-start gap-4">
                                        <div class="w-10 h-10 bg-muted rounded-lg flex items-center justify-center flex-shrink-0">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-foreground">{{ $event->title }}</p>
                                            <p class="text-sm text-gray-500">{{ $event->yayasan->name }}</p>
                                            @if($event->isOngoing())
                                                <span class="inline-block mt-1 px-2 py-0.5 bg-secondary/10 text-secondary text-xs font-semibold rounded-full">Ongoing</span>
                                            @endif
                                        </div>
                                    </div>
                                </button>
                            @empty
                                <div class="text-center py-8 text-gray-500">
                                    <p>No events available at the moment.</p>
                                    <a href="{{ route('events.map') }}" class="text-primary hover:underline mt-2 inline-block">Browse on map</a>
                                </div>
                            @endforelse
                        </div>
                        
                        @error('eventId')
                            <p class="mt-4 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                
                <!-- Step 2: Donation Details -->
                @if($step === 2)
                    <div>
                        <h2 class="text-xl font-bold text-foreground mb-4">Donation Details</h2>
                        <p class="text-gray-600 mb-6">Tell us about your donation</p>
                        
                        <!-- Selected Event Summary -->
                        @if($selectedEvent)
                            <div class="mb-6 p-3 bg-muted rounded-lg text-sm">
                                <span class="font-medium text-foreground">{{ $selectedEvent->title }}</span>
                                <span class="text-gray-500">→ {{ $selectedEvent->yayasan->name }}</span>
                            </div>
                        @endif
                        
                        <div class="space-y-6">
                            <!-- Weight -->
                            <div>
                                <label for="weight" class="block text-sm font-semibold text-foreground mb-2">Estimated Weight (kg) *</label>
                                <input 
                                    wire:model="weight_kg"
                                    type="number"
                                    step="0.1"
                                    id="weight"
                                    class="w-full px-4 py-3 bg-muted rounded-md text-foreground placeholder-gray-500 border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all"
                                    placeholder="e.g., 2.5"
                                >
                                @error('weight_kg')
                                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-semibold text-foreground mb-2">What are you donating? *</label>
                                <textarea 
                                    wire:model="description"
                                    id="description"
                                    rows="4"
                                    class="w-full px-4 py-3 bg-muted rounded-md text-foreground placeholder-gray-500 border-2 border-transparent focus:border-primary focus:bg-white focus:outline-none transition-all resize-none"
                                    placeholder="e.g., 5 bags of rice, 10 cans of sardines, clean clothes..."
                                ></textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- Photo Upload -->
                            <div>
                                <label class="block text-sm font-semibold text-foreground mb-2">Photo (Optional)</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors">
                                    @if($photo)
                                        <div class="mb-3">
                                            <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="max-h-40 mx-auto rounded-lg">
                                        </div>
                                        <button wire:click="$set('photo', null)" class="text-red-600 text-sm font-medium hover:underline">Remove photo</button>
                                    @else
                                        <input 
                                            type="file" 
                                            wire:model="photo" 
                                            accept="image/*"
                                            class="hidden"
                                            id="photo-upload"
                                        >
                                        <label for="photo-upload" class="cursor-pointer">
                                            <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-sm text-gray-600">Click to upload a photo of your donation</p>
                                            <p class="text-xs text-gray-400 mt-1">Max 5MB</p>
                                        </label>
                                    @endif
                                    <div wire:loading wire:target="photo" class="mt-2 text-primary text-sm">Uploading...</div>
                                </div>
                                @error('photo')
                                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
                
                <!-- Step 3: Delivery Method -->
                @if($step === 3)
                    <div>
                        <h2 class="text-xl font-bold text-foreground mb-4">Delivery Method</h2>
                        <p class="text-gray-600 mb-6">How will you deliver your donation?</p>
                        
                        <!-- Summary -->
                        @if($selectedEvent)
                            <div class="mb-6 p-4 bg-muted rounded-lg">
                                <h3 class="font-semibold text-foreground mb-2">Donation Summary</h3>
                                <div class="text-sm space-y-1">
                                    <p><span class="text-gray-500">Event:</span> {{ $selectedEvent->title }}</p>
                                    <p><span class="text-gray-500">To:</span> {{ $selectedEvent->yayasan->name }}</p>
                                    <p><span class="text-gray-500">Weight:</span> {{ $weight_kg }} kg</p>
                                    <p><span class="text-gray-500">Items:</span> {{ \Str::limit($description, 50) }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="space-y-3">
                            <!-- Self Delivery -->
                            <label class="flex items-start gap-4 p-4 rounded-lg border-2 cursor-pointer transition-all hover:shadow-sm
                                {{ $delivery_method === 'self' ? 'border-primary bg-primary/5' : 'border-gray-200 hover:border-gray-300' }}">
                                <input type="radio" wire:model="delivery_method" value="self" class="mt-1 hidden">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0 {{ $delivery_method === 'self' ? 'bg-primary' : 'bg-muted' }}">
                                    <svg class="w-6 h-6 {{ $delivery_method === 'self' ? 'text-white' : 'text-gray-500' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-foreground">Self Delivery</p>
                                    <p class="text-sm text-gray-500">I will deliver the donation myself to the foundation</p>
                                    @if($selectedEvent && $selectedEvent->yayasan->address)
                                        <p class="text-xs text-primary mt-1">📍 {{ $selectedEvent->yayasan->address }}</p>
                                    @endif
                                </div>
                                @if($delivery_method === 'self')
                                    <svg class="w-6 h-6 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                @endif
                            </label>
                            
                            <!-- Courier -->
                            <label class="flex items-start gap-4 p-4 rounded-lg border-2 cursor-pointer transition-all hover:shadow-sm
                                {{ $delivery_method === 'courier' ? 'border-primary bg-primary/5' : 'border-gray-200 hover:border-gray-300' }}">
                                <input type="radio" wire:model="delivery_method" value="courier" class="mt-1 hidden">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0 {{ $delivery_method === 'courier' ? 'bg-primary' : 'bg-muted' }}">
                                    <svg class="w-6 h-6 {{ $delivery_method === 'courier' ? 'text-white' : 'text-gray-500' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-foreground">Online Courier</p>
                                    <p class="text-sm text-gray-500">Send via Gojek, Grab, or similar services</p>
                                </div>
                                @if($delivery_method === 'courier')
                                    <svg class="w-6 h-6 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                @endif
                            </label>
                            
                            <!-- Expedition -->
                            <label class="flex items-start gap-4 p-4 rounded-lg border-2 cursor-pointer transition-all hover:shadow-sm
                                {{ $delivery_method === 'expedition' ? 'border-primary bg-primary/5' : 'border-gray-200 hover:border-gray-300' }}">
                                <input type="radio" wire:model="delivery_method" value="expedition" class="mt-1 hidden">
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center flex-shrink-0 {{ $delivery_method === 'expedition' ? 'bg-primary' : 'bg-muted' }}">
                                    <svg class="w-6 h-6 {{ $delivery_method === 'expedition' ? 'text-white' : 'text-gray-500' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="font-semibold text-foreground">Expedition Service</p>
                                    <p class="text-sm text-gray-500">Send via JNE, J&T, SiCepat, or similar</p>
                                </div>
                                @if($delivery_method === 'expedition')
                                    <svg class="w-6 h-6 text-primary flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                @endif
                            </label>
                        </div>
                        
                        @error('delivery_method')
                            <p class="mt-4 text-sm text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                
                <!-- Navigation Buttons -->
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                    @if($step > 1)
                        <button wire:click="previousStep" class="btn-outline">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back
                        </button>
                    @else
                        <a href="{{ route('events.map') }}" class="btn-outline">Cancel</a>
                    @endif
                    
                    @if($step < 3)
                        <button wire:click="nextStep" class="btn-primary">
                            Continue
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                    @else
                        <button 
                            wire:click="submit" 
                            class="btn-primary !bg-secondary hover:!bg-emerald-600"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-75 cursor-wait"
                        >
                            <span wire:loading.remove>Submit Donation</span>
                            <span wire:loading class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                                Submitting...
                            </span>
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
