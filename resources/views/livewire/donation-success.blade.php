<div>
    <livewire:navbar />
    
    <div class="min-h-screen bg-muted flex items-center justify-center py-12 px-4">
        <div class="max-w-lg w-full">
            <div class="bg-white rounded-lg p-8 text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                
                <h1 class="text-2xl font-extrabold text-foreground mb-3">Donation Submitted!</h1>
                <p class="text-gray-600 mb-6">
                    Thank you for your generosity. Your donation has been submitted and is now pending review by the foundation.
                </p>
                
                <!-- Status Info -->
                <div class="bg-muted rounded-lg p-4 mb-6 text-left">
                    <h3 class="font-semibold text-foreground mb-2">What happens next?</h3>
                    <ol class="text-sm text-gray-600 space-y-2">
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 bg-primary/10 text-primary rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">1</span>
                            <span>The foundation will review your donation request</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 bg-primary/10 text-primary rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">2</span>
                            <span>You'll receive a notification when it's accepted</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 bg-primary/10 text-primary rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">3</span>
                            <span>Deliver your donation using your chosen method</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="w-5 h-5 bg-secondary/10 text-secondary rounded-full flex items-center justify-center font-bold text-xs flex-shrink-0 mt-0.5">✓</span>
                            <span>Confirmation when donation is received!</span>
                        </li>
                    </ol>
                </div>
                
                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('dashboard') }}" class="flex-1 btn-primary">
                        Go to Dashboard
                    </a>
                    <a href="{{ route('events.map') }}" class="flex-1 btn-outline">
                        Make Another Donation
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
