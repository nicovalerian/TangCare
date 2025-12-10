<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'TangCare' }}</title>
    <meta name="description" content="TangCare - Hyperlocal Donation Platform for Tangerang">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="min-h-screen bg-primary">
    <!-- Geometric Background Decorations -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-white/5 rounded-full"></div>
        <div class="absolute top-1/3 -left-20 w-80 h-80 bg-white/5 rounded-full"></div>
        <div class="absolute bottom-20 right-1/4 w-40 h-40 bg-white/10 rotate-45"></div>
        <div class="absolute top-1/2 left-1/3 w-20 h-20 bg-white/10 rotate-12"></div>
        <div class="absolute bottom-1/4 left-10 w-32 h-32 bg-secondary/20 rounded-full"></div>
    </div>
    
    <div class="relative min-h-screen flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Logo -->
            <a href="/" class="flex items-center justify-center gap-3 mb-8 group">
                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center transition-transform duration-200 group-hover:scale-110">
                    <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <span class="text-2xl font-bold text-white tracking-tight">TangCare</span>
            </a>
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <!-- Card -->
            <div class="bg-white py-8 px-6 sm:px-10 rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </div>
    
    @livewireScripts
    @stack('scripts')
</body>
</html>

