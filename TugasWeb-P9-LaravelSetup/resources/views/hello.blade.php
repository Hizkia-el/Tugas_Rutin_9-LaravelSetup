{{-- ==================================================================
     resources/views/hello.blade.php
     BONUS: route parameter -> /hello/{nama}
     ================================================================== --}}
@extends('layouts.app')

@section('title', 'Hello - Tugas Rutin 9')

@section('content')
    <div class="hello">
        <p class="emoji">👋</p>
        <h1>Halo, <span>{{ $sapaan['nama'] }}</span>!</h1>
        <p>Sekarang: {{ $sapaan['waktu'] }}</p>
        <a href="{{ route('home') }}">&larr; Kembali ke beranda</a>
    </div>
@endsection
