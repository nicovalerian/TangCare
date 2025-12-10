<x-layouts.app title="TangCare - Hyperlocal Donation Platform Tangerang">
    <!-- Navbar -->
    <livewire:navbar />

    <!-- Hero Section - Blue Background with Geometric Decorations -->
    <section class="relative bg-primary overflow-hidden">
        <!-- Geometric Decorations -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/5 rounded-full"></div>
            <div class="absolute top-1/2 -left-16 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute bottom-10 right-1/4 w-32 h-32 bg-white/10 rotate-45"></div>
            <div class="absolute top-20 left-1/3 w-16 h-16 bg-white/10 rotate-12"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Hero Text -->
                <div class="text-center lg:text-left">
                    <span class="inline-block px-4 py-2 bg-white/10 text-white font-medium rounded-full mb-6 uppercase tracking-wider text-sm">
                        Tangerang Care Initiative
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                        Connect<span class="text-accent">.</span> Donate<span class="text-accent">.</span> Impact<span class="text-accent">.</span>
                    </h1>
                    <p class="text-xl text-white/80 mb-8 max-w-lg mx-auto lg:mx-0">
                        A hyperlocal donation platform connecting donors directly with verified foundations in Tangerang. Track your impact, every kilogram.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="/register" class="btn-primary !bg-white !text-primary hover:!bg-gray-100">
                            Start Donating
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                        <a href="#how-it-works" class="btn-outline !border-white !text-white hover:!bg-white hover:!text-primary">
                            Learn More
                        </a>
                    </div>
                </div>
                
                <!-- Hero Illustration - Meaningful Visual Story -->
                <div class="hidden lg:flex justify-center items-center relative">
                    <div class="relative w-96 h-80">
                        <!-- Connection Lines (animated) -->
                        <svg class="absolute inset-0 w-full h-full" viewBox="0 0 400 320">
                            <path d="M80 160 Q200 80 320 160" stroke="rgba(255,255,255,0.2)" stroke-width="3" fill="none" stroke-dasharray="8 8">
                                <animate attributeName="stroke-dashoffset" from="16" to="0" dur="1s" repeatCount="indefinite" />
                            </path>
                            <path d="M80 160 Q200 240 320 160" stroke="rgba(255,255,255,0.15)" stroke-width="3" fill="none" stroke-dasharray="8 8">
                                <animate attributeName="stroke-dashoffset" from="0" to="16" dur="1.5s" repeatCount="indefinite" />
                            </path>
                        </svg>
                        
                        <!-- Donor Side (Left) -->
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 flex flex-col items-center">
                            <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg mb-2">
                                <svg class="w-10 h-10 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="text-white/80 text-sm font-medium">Donors</span>
                        </div>
                        
                        <!-- Center Heart Icon -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 bg-white rounded-2xl flex items-center justify-center shadow-xl animate-pulse">
                            <svg class="w-12 h-12 text-accent" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                        </div>
                        
                        <!-- Package floating -->
                        <div class="absolute top-8 left-1/2 -translate-x-1/2 w-14 h-14 bg-secondary rounded-lg flex items-center justify-center shadow-lg animate-bounce" style="animation-delay: 0.5s; animation-duration: 2s;">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        
                        <!-- Foundation Side (Right) -->
                        <div class="absolute right-0 top-1/2 -translate-y-1/2 flex flex-col items-center">
                            <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center shadow-lg mb-2">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <span class="text-white/80 text-sm font-medium">Yayasans</span>
                        </div>
                        
                        <!-- Floating Stats -->
                        <div class="absolute bottom-4 left-1/4 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-2">
                            <p class="text-white text-xs font-bold">500+ kg</p>
                            <p class="text-white/60 text-xs">donated</p>
                        </div>
                        <div class="absolute bottom-4 right-1/4 bg-white/20 backdrop-blur-sm rounded-lg px-3 py-2">
                            <p class="text-white text-xs font-bold">25+</p>
                            <p class="text-white/60 text-xs">verified</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section - Gray Background -->
    <section id="features" class="bg-muted py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-primary/10 text-primary font-semibold rounded-full mb-4 uppercase tracking-wider text-sm">
                    Why TangCare?
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-foreground mb-4">
                    Features That Matter
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Designed for transparency, simplicity, and real community impact.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="group card-interactive bg-white p-8">
                    <div class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center mb-6 transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Verified Foundations</h3>
                    <p class="text-gray-600">All yayasans are verified with valid Tangerang addresses. Donate with confidence.</p>
                </div>
                
                <!-- Feature Card 2 -->
                <div class="group card-interactive bg-white p-8">
                    <div class="w-14 h-14 bg-secondary rounded-lg flex items-center justify-center mb-6 transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Interactive Map</h3>
                    <p class="text-gray-600">Find nearby events and drop-off points with our real-time Leaflet-powered map.</p>
                </div>
                
                <!-- Feature Card 3 -->
                <div class="group card-interactive bg-white p-8">
                    <div class="w-14 h-14 bg-accent rounded-lg flex items-center justify-center mb-6 transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Track Your Impact</h3>
                    <p class="text-gray-600">See exactly how many kilograms you've donated and your contribution to the community.</p>
                </div>
                
                <!-- Feature Card 4 -->
                <div class="group card-interactive bg-white p-8">
                    <div class="w-14 h-14 bg-primary rounded-lg flex items-center justify-center mb-6 transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Event Discovery</h3>
                    <p class="text-gray-600">Browse ongoing charity events and find the perfect cause to support.</p>
                </div>
                
                <!-- Feature Card 5 -->
                <div class="group card-interactive bg-white p-8">
                    <div class="w-14 h-14 bg-secondary rounded-lg flex items-center justify-center mb-6 transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Real-time Updates</h3>
                    <p class="text-gray-600">Get notified when your donation is accepted, picked up, or received.</p>
                </div>
                
                <!-- Feature Card 6 -->
                <div class="group card-interactive bg-white p-8">
                    <div class="w-14 h-14 bg-accent rounded-lg flex items-center justify-center mb-6 transition-transform duration-200 group-hover:scale-110">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-foreground mb-3">Direct P2P Connection</h3>
                    <p class="text-gray-600">Connect directly with foundations. No middlemen, no hidden fees.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section - Dark Gray Background -->
    <section id="how-it-works" class="bg-gray-900 py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-white/10 text-white font-semibold rounded-full mb-4 uppercase tracking-wider text-sm">
                    Simple Process
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-4">
                    How It Works
                </h2>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">
                    Three simple steps to make a real difference in your community.
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 lg:gap-12">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl font-extrabold text-white">1</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Browse Events</h3>
                    <p class="text-gray-400">Explore ongoing charity events on our interactive map and find causes you care about.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl font-extrabold text-white">2</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Submit Donation</h3>
                    <p class="text-gray-400">Fill out the donation form with item details, weight, and your preferred delivery method.</p>
                </div>
                
                <!-- Step 3 -->
                <div class="text-center">
                    <div class="w-20 h-20 bg-accent rounded-full flex items-center justify-center mx-auto mb-6">
                        <span class="text-3xl font-extrabold text-white">3</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Track Impact</h3>
                    <p class="text-gray-400">Get notified as your donation is received and see your total contribution grow.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section - White Background -->
    <section id="stats" class="bg-white py-20 lg:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-muted text-foreground font-semibold rounded-full mb-4 uppercase tracking-wider text-sm">
                    Our Impact
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-foreground mb-4">
                    Numbers That Matter
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Together, we're building a more caring Tangerang.
                </p>
            </div>
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Stat 1 -->
                <div class="text-center p-6">
                    <div class="text-5xl lg:text-6xl font-extrabold text-primary mb-2">500+</div>
                    <div class="text-lg font-semibold text-gray-600 uppercase tracking-wide">Kg Donated</div>
                </div>
                
                <!-- Stat 2 -->
                <div class="text-center p-6">
                    <div class="text-5xl lg:text-6xl font-extrabold text-secondary mb-2">25+</div>
                    <div class="text-lg font-semibold text-gray-600 uppercase tracking-wide">Yayasans</div>
                </div>
                
                <!-- Stat 3 -->
                <div class="text-center p-6">
                    <div class="text-5xl lg:text-6xl font-extrabold text-accent mb-2">100+</div>
                    <div class="text-lg font-semibold text-gray-600 uppercase tracking-wide">Donors</div>
                </div>
                
                <!-- Stat 4 -->
                <div class="text-center p-6">
                    <div class="text-5xl lg:text-6xl font-extrabold text-primary mb-2">50+</div>
                    <div class="text-lg font-semibold text-gray-600 uppercase tracking-wide">Events</div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section - Amber Background -->
    <section class="bg-accent py-20 lg:py-28 relative overflow-hidden">
        <!-- Geometric Decorations -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/10 rounded-full"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-white/5 rotate-45"></div>
        </div>
        
        <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white mb-6">
                Ready to Make a Difference?
            </h2>
            <p class="text-xl text-white/80 mb-8 max-w-2xl mx-auto">
                Join hundreds of donors in Tangerang who are creating real impact in their community.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/register" class="btn-primary !bg-white !text-accent hover:!bg-gray-100">
                    Get Started Now
                </a>
                <a href="{{ route('events.map') }}" class="btn-outline !border-4 !border-white !text-white hover:!bg-white hover:!text-accent">
                    Find Events
                </a>
            </div>
        </div>
    </section>

    <!-- Footer - Dark Gray -->
    <footer class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight">TangCare</span>
                    </div>
                    <p class="text-gray-400 max-w-sm">
                        A hyperlocal donation platform for Tangerang. Connecting donors with verified foundations for transparent, impactful giving.
                    </p>
                </div>
                
                <!-- Links -->
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase tracking-wide text-sm">Platform</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('events.map') }}" class="text-gray-400 hover:text-white transition-colors">Find Events</a></li>
                        <li><a href="#how-it-works" class="text-gray-400 hover:text-white transition-colors">How It Works</a></li>
                        <li><a href="#stats" class="text-gray-400 hover:text-white transition-colors">Impact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-white font-semibold mb-4 uppercase tracking-wide text-sm">Account</h4>
                    <ul class="space-y-2">
                        <li><a href="/login" class="text-gray-400 hover:text-white transition-colors">Login</a></li>
                        <li><a href="/register" class="text-gray-400 hover:text-white transition-colors">Register</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t-2 border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} TangCare. Made with ❤️ for Tangerang.
                </p>
            </div>
        </div>
    </footer>
</x-layouts.app>
