<!DOCTYPE html>
{{-- ==================================================================
     resources/views/layouts/app.blade.php
     Layout bersama untuk semua halaman (@extends / @yield).
     Style: public/css/style.css (tema langit malam, CSS terpisah).
     ================================================================== --}}
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') · Yobel Hizkia Sijabat</title>
    <meta name="description" content="Portofolio Yobel Hizkia Sijabat — Tugas Rutin 9, Setup Laravel.">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <!-- LAYER TEMA -->
    <div class="stars"></div>
    <div class="meteor-shower">
        <div class="comet"></div>
        <div class="comet"></div>
        <div class="comet"></div>
    </div>

    <div class="container">
        <nav>
            <div class="logo"><a href="{{ route('home') }}">STRAYEL</a></div>
            <ul>
                <li><a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Beranda</a></li>
                <li><a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>Tentang</a></li>
                <li><a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Kontak</a></li>
            </ul>
        </nav>

        @if (session('success'))
            <div class="alert" role="status">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} Yobel Hizkia Sijabat · Tugas Rutin 9 — Setup Laravel · Pemrograman Web</p>
    </footer>

</body>
</html>
