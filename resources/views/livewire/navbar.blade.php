<nav class="bg-white border-b-2 border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo -->
            <a href="{{ auth()->check() ? route('dashboard') : route('home') }}" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center transition-transform duration-200 group-hover:scale-110">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-foreground tracking-tight">TangCare</span>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center gap-8">
                @auth
                    {{-- Logged in: Show dashboard-relevant links --}}
                    <a href="{{ route('dashboard') }}" class="text-foreground font-medium hover:text-primary transition-colors duration-200">Dashboard</a>
                    <a href="{{ route('home') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Home</a>
                    @if(auth()->user()->isDonor())
                        <span class="text-gray-400 font-medium cursor-not-allowed" title="Coming soon">My Donations</span>
                        <a href="{{ route('events.map') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Find Events</a>
                    @elseif(auth()->user()->isYayasan())
                        <a href="{{ route('yayasan.events') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">My Events</a>
                        <span class="text-gray-400 font-medium cursor-not-allowed" title="Coming soon">Donations</span>
                    @elseif(auth()->user()->isAdmin())
                        <span class="text-gray-400 font-medium cursor-not-allowed" title="Coming soon">Users</span>
                        <a href="{{ route('admin.yayasans') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Yayasans</a>
                    @endif
                @else
                    {{-- Guest: Show homepage section links --}}
                    <a href="{{ route('home') }}" class="text-foreground font-medium hover:text-primary transition-colors duration-200">Home</a>
                    <a href="{{ route('events.map') }}" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Find Events</a>
                    <a href="{{ route('home') }}#how-it-works" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">How It Works</a>
                    <a href="{{ route('home') }}#stats" class="text-gray-600 font-medium hover:text-primary transition-colors duration-200">Impact</a>
                @endauth
            </div>

            <!-- Desktop Auth Links -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-sm font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                        <span class="text-sm font-medium text-foreground">{{ auth()->user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-secondary !py-2 !px-4">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-foreground font-medium hover:text-primary transition-colors duration-200">Login</a>
                    <a href="{{ route('register') }}" class="btn-primary !py-2 !px-6">Register</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button 
                wire:click="toggleMobileMenu" 
                class="md:hidden p-2 rounded-md text-foreground hover:bg-muted transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-primary"
                aria-label="Toggle menu"
            >
                @if($mobileMenuOpen)
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                @else
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                @endif
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    @if($mobileMenuOpen)
        <div class="md:hidden bg-white border-t-2 border-gray-100">
            <div class="px-4 py-4 space-y-3">
                @auth
                    {{-- Logged in mobile menu --}}
                    <div class="flex items-center gap-3 pb-3 border-b-2 border-gray-100">
                        <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                            <span class="text-lg font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-foreground">{{ auth()->user()->name }}</p>
                            <p class="text-sm text-gray-500 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                    </div>
                    <a href="{{ route('dashboard') }}" class="block text-foreground font-medium py-2 hover:text-primary transition-colors">Dashboard</a>
                    <a href="{{ route('home') }}" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Home</a>
                    @if(auth()->user()->isDonor())
                        <span class="block text-gray-400 font-medium py-2 cursor-not-allowed">My Donations (Coming soon)</span>
                        <a href="{{ route('events.map') }}" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Find Events</a>
                    @elseif(auth()->user()->isYayasan())
                        <a href="{{ route('yayasan.events') }}" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">My Events</a>
                        <span class="block text-gray-400 font-medium py-2 cursor-not-allowed">Donations (Coming soon)</span>
                    @elseif(auth()->user()->isAdmin())
                        <span class="block text-gray-400 font-medium py-2 cursor-not-allowed">Users (Coming soon)</span>
                        <a href="{{ route('admin.yayasans') }}" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Yayasans</a>
                    @endif
                    <div class="pt-3 border-t-2 border-gray-100">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full btn-secondary">Logout</button>
                        </form>
                    </div>
                @else
                    {{-- Guest mobile menu --}}
                    <a href="{{ route('home') }}" class="block text-foreground font-medium py-2 hover:text-primary transition-colors">Home</a>
                    <a href="{{ route('events.map') }}" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Find Events</a>
                    <a href="{{ route('home') }}#how-it-works" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">How It Works</a>
                    <a href="{{ route('home') }}#stats" class="block text-gray-600 font-medium py-2 hover:text-primary transition-colors">Impact</a>
                    <div class="pt-4 border-t-2 border-gray-100 space-y-3">
                        <a href="{{ route('login') }}" class="block text-foreground font-medium py-2 text-center hover:text-primary transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="block btn-primary text-center">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    @endif
</nav>
