<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Batangas Bulletin</title>
    <meta name="description" content="@yield('description', \App\Models\Setting::get('site_description', ''))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50">
<!-- Navigation -->
<x-nav></x-nav>

<!-- Main Content -->
<main>
    @yield('content')
</main>

<!-- Footer -->
<x-footer></x-footer>
</body>
</html>
