<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tours</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div id="app" class="container mx-auto px-4">
    <main class="py-8">
        @yield('content')
    </main>
</div>
</body>
</html>
