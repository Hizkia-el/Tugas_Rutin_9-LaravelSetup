{{-- ==================================================================
     resources/views/about.blade.php  —  route "/about"
     Data dinamis: array dari controller + tabel mahasiswas via Eloquent.
     ================================================================== --}}
@extends('layouts.app')

@section('title', 'Tentang')

@section('content')
    <h1 class="page-title">{{ $tentang['judul'] }}</h1>
    <p class="page-lead">{{ $tentang['isi'] }}</p>

    <main>
        <!-- PROYEK LATIHAN -->
        <section id="proyek">
            <h2 class="section-title">Proyek & Latihan Terkini</h2>
            <p class="inline-style-3">Pembaruan terakhir:
                <time datetime="{{ $pembaruan['tanggal'] }}">{{ $pembaruan['teks'] }}</time>
            </p>

            <div class="grid-cards">
                @foreach ($proyek as $item)
                    <article class="card">
                        <h3>{{ $item['judul'] }}</h3>
                        <p>{{ $item['isi'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <aside>
            <h3>{{ $catatan['judul'] }}</h3>
            <p>{{ $catatan['isi'] }}</p>
        </aside>

        <!-- DATA DARI DATABASE -->
        <section>
            <h2 class="section-title">Data Mahasiswa</h2>
            <p class="inline-style-3">Diambil dari database lewat model <code>Mahasiswa</code> (Eloquent).</p>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>GitHub</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mahasiswaList as $mhs)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mhs->nama }}</td>
                                <td>{{ $mhs->email }}</td>
                                <td><a href="https://github.com/{{ $mhs->github }}" target="_blank" rel="noopener noreferrer">{{ $mhs->github }}</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty">
                                    Belum ada data. Jalankan <code>php artisan migrate --seed</code>.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </main>
@endsection
