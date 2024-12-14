<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dental Clinic') }} - {{ $title ?? '' }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <x-layout.navigation />

        <!-- Sidebar & Main Content -->
        <div class="flex">
            <!-- Sidebar -->
            <x-layout.sidebar />

            <!-- Main Content -->
            <main class="flex-1 p-8">
                <!-- Flash Messages -->
                <x-layout.flash-messages />

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <div class="py-6">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>
</html> 