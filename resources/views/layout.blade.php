<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/js/app.js'])
        @vite(['resources/css/app.css'])
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    @yield('content')
</html>