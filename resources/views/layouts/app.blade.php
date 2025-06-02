<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - {{ $title }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
</head>

<body>

    <main class="container d-flex justify-content-center align-items-center">
        <div class="w-75 mt-5">

            @if(session('success'))
                <div class="my-2">
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        <span class="mx-2"> {{ session('success') }} </span>
                        <button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>
                </div>
            @endif
            
            {{ $main }}
        </div>
    </main>

    @yield('script')

</body>

</html>