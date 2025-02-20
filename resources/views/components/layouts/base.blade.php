<!DOCTYPE html>
<html class="h-full bg-white" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title . ' | ' . config('app.name') ?? config('app.name') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url(asset('favicon.ico')) }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
    @livewireScripts

    <!-- Flux Styles -->
    @fluxStyles

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="h-full">
    @yield('body')

    <!-- Livewire Modal -->
    @livewire('wire-elements-modal')

    <!-- Flux Scripts -->
    @fluxScripts
</body>

</html>
