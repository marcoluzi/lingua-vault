@extends('components.layouts.base')

@section('body')
    <div x-data="{ isOpen: false }" @keydown.window.escape="isOpen = false">
        {{-- TODO: Can I combine mobile and desktop sidebar into one? --}}
        <x-ui.mobile-sidebar />
        <x-ui.desktop-sidebar />
        <x-ui.mobile-header />
        <main class="py-10 lg:pl-72">
            <div class="px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
@endsection
