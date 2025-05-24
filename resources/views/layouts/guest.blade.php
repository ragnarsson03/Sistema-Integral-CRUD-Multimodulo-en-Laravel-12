<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'UNETI') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Estilos de autenticación y navbar -->
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    </head>
    <body class="font-sans text-gray-900 antialiased auth-page-bg">
        <!-- Incluir el navbar compartido -->
        <x-navbar />
        
        <div class="min-h-screen flex flex-col items-center pt-6">
            <div class="w-full sm:max-w-md mt-10 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg auth-container">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
