<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') - {{ \App\Models\Setting::get('site_name', 'My Blog') }}</title>
    <meta name="description" content="@yield('description', \App\Models\Setting::get('site_description', ''))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
<!-- Navigation -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('blog.index') }}" class="text-2xl font-bold text-gray-900">
                    {{ \App\Models\Setting::get('site_name', 'My Blog') }}
                </a>
            </div>

            <div class="flex items-center space-x-8">
                <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                    Home
                </a>

                <!-- Categories Dropdown -->
                <div class="relative group">
                    <button class="text-gray-700 hover:text-blue-600 font-medium flex items-center">
                        Categories
                        <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                        @foreach(\App\Models\Category::all() as $category)
                            <a href="{{ route('blog.category', $category->slug) }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <span class="inline-block w-3 h-3 rounded-full mr-2" style="background-color: {{ $category->color }}"></span>
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-600 font-medium">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-2">
                <h3 class="text-xl font-bold mb-4">{{ \App\Models\Setting::get('site_name', 'My Blog') }}</h3>
                <p class="text-gray-400 mb-4">{{ \App\Models\Setting::get('site_description', '') }}</p>
                <p class="text-gray-400">Contact: {{ \App\Models\Setting::get('contact_email', '') }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Categories</h4>
                <ul class="space-y-2">
                    @foreach(\App\Models\Category::all() as $category)
                        <li>
                            <a href="{{ route('blog.category', $category->slug) }}"
                               class="text-gray-400 hover:text-white">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white">Home</a></li>
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-white">Dashboard</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-gray-400 hover:text-white">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-gray-400 hover:text-white">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'My Blog') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
</body>
</html>
