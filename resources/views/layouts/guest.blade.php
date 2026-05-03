<!-- resources/views/layouts/guest.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Font Awesome untuk Icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <!-- Hapus sm:max-w-md dan padding-padding yang mengganggu -->
        <div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
            <div class="w-full flex justify-center">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>