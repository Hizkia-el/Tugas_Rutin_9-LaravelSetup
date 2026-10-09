{{-- ==================================================================
     resources/views/contact.blade.php  —  route "/contact"
     REQUIREMENT 5: $kontak (array bersarang) dirender dinamis.
     Form: @csrf, pesan error per field (@error) dan old input.
     ================================================================== --}}
@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    <h1 class="page-title">Hubungi <span>Saya</span></h1>

    <main>
        <section id="kontak" style="padding-top: 20px;">
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h3>{{ $kontak['judul'] }}</h3>
                    <p class="inline-style-4">{{ $kontak['intro'] }}</p>

                    <div class="contact-links">
                        @foreach ($kontak['tautan'] as $tautan)
                            <a href="{{ $tautan['url'] }}" @if ($tautan['baru']) target="_blank" rel="noopener noreferrer" @endif>{{ $tautan['label'] }}</a>
                        @endforeach
                    </div>
                </div>

                <form action="{{ route('contact.send') }}" method="POST" novalidate>
                    @csrf

                    <div>
                        <label for="nama">Nama Anda</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso" @class(['is-invalid' => $errors->has('nama')]) required>
                        @error('nama') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="hello@domain.com" @class(['is-invalid' => $errors->has('email')]) required>
                        @error('email') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="tanggal_pesan">Tanggal Pengisian</label>
                        <input type="date" id="tanggal_pesan" name="tanggal_pesan" value="{{ old('tanggal_pesan') }}" @class(['is-invalid' => $errors->has('tanggal_pesan')]) required>
                        @error('tanggal_pesan') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="ketertarikan">Tingkat Ketertarikan pada Pemrograman Web (1 - 5)</label>
                        <input type="range" id="ketertarikan" name="ketertarikan" min="1" max="5" value="{{ old('ketertarikan', 4) }}">
                        @error('ketertarikan') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="warna_tema">Warna Web Favorit</label>
                        <input type="color" id="warna_tema" name="warna_tema" value="{{ old('warna_tema', '#6699ff') }}">
                        @error('warna_tema') <p class="field-error">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit">Kirim Pesan</button>
                </form>
            </div>
        </section>
    </main>
@endsection
