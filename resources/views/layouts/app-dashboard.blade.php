<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', env('APP_NAME', 'Aplicação')) }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-800 antialiased">
    <x-dashboard.sidebar />
    <x-dashboard.topbar />

    <main class="ml-64 pt-16 p-6">
        {{ $slot }}
    </main>
</body>
</html>
