<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - {{ $title }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js']) <!-- se estiver usando Vite -->
    
</head>

<body>

    <main class="container d-flex justify-content-center align-items-center">
        <div class="w-75 mt-5">
            {{ $main }}
        </div>
    </main>

</body>

</html>