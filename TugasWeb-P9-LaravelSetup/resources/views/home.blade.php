{{-- ==================================================================
     resources/views/home.blade.php  —  route "/"
     REQUIREMENT 5: semua data ($profil, $fokus, $menu) berasal dari controller.
     ================================================================== --}}
@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- HERO -->
    <header class="hero">
        <div class="hero-text">
            <p>— Halo, perkenalkan saya</p>
            <h1>{{ $profil['nama_depan'] }} <br><span>{{ $profil['nama_tengah'] }}</span></h1>
            <p>{{ $profil['intro'] }}</p>
            <a href="{{ route('contact') }}" class="inline-style-1">Sapa Saya ↗</a>
        </div>

        <figure class="hero-image">
            <img src="{{ asset($profil['foto']) }}" alt="{{ $profil['nama'] }} Portrait">
            <figcaption>{{ $profil['caption'] }}</figcaption>
        </figure>
    </header>

    <main>
        <!-- INFO TUGAS -->
        <div class="info-strip">
            <div class="card">
                <p class="label">Mata Kuliah</p>
                <p class="value">{{ $profil['matkul'] }}</p>
            </div>
            <div class="card">
                <p class="label">Tugas</p>
                <p class="value">{{ $profil['tugas'] }}</p>
            </div>
        </div>

        <!-- FOKUS BELAJAR -->
        <section id="sedang-dipelajari">
            <h2 class="section-title">Yang Sedang Saya Pelajari</h2>
            <div class="grid-cards">
                @foreach ($fokus as $item)
                    <article @class(['card', 'inline-style-2' => $item['sorot']])>
                        <h3>{{ $item['judul'] }}</h3>
                        <p>{{ $item['isi'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <!-- MENU HALAMAN -->
        <section>
            <h2 class="section-title">Jelajahi Halaman</h2>
            <div class="grid-cards">
                @foreach ($menu as $item)
                    <a href="{{ $item['url'] }}" class="card">
                        <h3>{{ $item['judul'] }}</h3>
                        <p>{{ $item['deskripsi'] }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    </main>
@endsection
