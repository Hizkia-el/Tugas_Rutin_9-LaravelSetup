<?php

// ====================================================================
// app/Http/Controllers/HomeController.php
// Dibuat dengan: php artisan make:controller HomeController
// REQUIREMENT 4 & 5: 3 route custom, masing-masing mengirim data
//                    dinamis (array) ke Blade view.
// Sumber data: landing page Yobel Hizkia Sijabat (web_pisah_css).
// ====================================================================

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Route "/" -> halaman beranda.
     * REQUIREMENT 5: data dinamis berupa array dikirim dari route/controller.
     */
    public function index(): View
    {
        $profil = [
            'nama'        => 'Yobel Hizkia Sijabat',
            'nama_depan'  => 'Yobel',
            'nama_tengah' => 'Hizkia',
            'intro'       => 'Mahasiswa yang sedang antusias mempelajari dasar-dasar Pemrograman Web. '
                . 'Senang mengeksplorasi kode untuk membangun halaman web yang rapi dan menarik.',
            'foto'        => 'images/foto-yobel.jpg',
            'caption'     => 'Berproses memahami logika & desain web',
            'matkul'      => 'Pemrograman Web',
            'tugas'       => 'Tugas Rutin 9 — Setup Laravel',
        ];

        $fokus = [
            [
                'judul' => '📚 Dasar HTML5 & CSS3',
                'isi'   => 'Mempelajari cara menyusun struktur halaman web yang benar (semantik) '
                    . 'dan memberikan gaya (styling) dasar yang responsif.',
                'sorot' => false,
            ],
            [
                'judul' => '🎨 Pengenalan UI/UX',
                'isi'   => 'Mencoba memahami bagaimana kombinasi warna, jarak (padding/margin), '
                    . 'dan tata letak memengaruhi kenyamanan pengunjung web.',
                'sorot' => false,
            ],
            [
                'judul' => '✨ Eksplorasi Interaksi CSS',
                'isi'   => 'Mengulik cara kerja hover, transisi, dan animasi sederhana '
                    . 'menggunakan murni CSS tanpa JavaScript.',
                'sorot' => true,
            ],
        ];

        $menu = [
            ['judul' => 'Tentang',  'deskripsi' => 'Proyek latihan, catatan belajar, dan data mahasiswa', 'url' => route('about')],
            ['judul' => 'Kontak',   'deskripsi' => 'Hubungi saya lewat media sosial atau formulir',      'url' => route('contact')],
            ['judul' => 'Hello',    'deskripsi' => 'Bonus route parameter: /hello/{nama}',               'url' => route('hello', 'yobel')],
        ];

        return view('home', [
            'profil' => $profil,
            'fokus'  => $fokus,
            'menu'   => $menu,
        ]);
    }

    /**
     * Route "/about" -> halaman tentang.
     */
    public function about(): View
    {
        $tentang = [
            'judul' => 'Tentang Tugas Ini',
            'isi'   => 'Project ini dibuat untuk memenuhi Tugas Rutin 9 — Setup Laravel pada mata kuliah '
                . 'Pemrograman Web: instalasi Composer, koneksi database MySQL, route custom, '
                . 'Blade view, dan data dinamis yang dikirim dari controller.',
        ];

        $pembaruan = ['tanggal' => '2026-08-25', 'teks' => '25 Agustus 2026'];

        $proyek = [
            [
                'judul' => 'Latihan 1 - Landing Page Pribadi',
                'isi'   => 'Tugas awal membuat portofolio sederhana berbasis HTML & CSS. Menerapkan '
                    . 'struktur semantik dan bereksperimen dengan efek visual langit malam.',
            ],
            [
                'judul' => 'Eksperimen Formulir HTML',
                'isi'   => 'Mencoba berbagai tag input baru pada form HTML seperti slider (range), '
                    . 'pemilih tanggal (date), dan pemilih warna (color).',
            ],
        ];

        $catatan = [
            'judul' => 'Catatan Pembelajaran',
            'isi'   => 'Website ini adalah ruang praktik bagi saya untuk menyelesaikan Tugas Rutin kuliah. '
                . 'Struktur kode ini terus diperbaiki agar sesuai dengan standar kevalidan W3C Validator.',
        ];

        // Ambil data dari tabel mahasiswas (REQUIREMENT 6: model + migration).
        $mahasiswaList = Mahasiswa::orderBy('nama')->get();

        return view('about', [
            'tentang'       => $tentang,
            'pembaruan'     => $pembaruan,
            'proyek'        => $proyek,
            'catatan'       => $catatan,
            'mahasiswaList' => $mahasiswaList,
        ]);
    }

    /**
     * Route "/contact" -> halaman kontak.
     */
    public function contact(): View
    {
        $kontak = [
            'nama'  => 'Yobel Hizkia Sijabat',
            'judul' => 'Mari Terhubung!',
            'intro' => 'Punya saran, masukan terkait kode saya, atau ingin bertukar pikiran '
                . 'sesama pemula di dunia web? Silakan hubungi saya melalui media di bawah ini:',
            // REQUIREMENT 5: array bersarang yang dirender dinamis di view.
            'tautan' => [
                ['label' => 'Instagram', 'url' => 'https://instagram.com/hizkia002',                       'baru' => true],
                ['label' => 'Email',     'url' => 'mailto:yobelhizkia.4253550004@mhs.unimed.ac.id',        'baru' => false],
                ['label' => 'GitHub',    'url' => 'https://github.com/Hizkia-el',                          'baru' => true],
            ],
        ];

        return view('contact', ['kontak' => $kontak]);
    }

    /**
     * POST "/contact" -> memproses formulir kontak.
     * Validasi ada di ContactRequest; pesan belum disimpan / dikirim (mode demo).
     */
    public function sendContact(ContactRequest $request): RedirectResponse
    {
        $nama = $request->validated('nama');

        return redirect()->route('contact')->with(
            'success',
            "Terima kasih, {$nama}! Formulir sudah valid (mode demo: pesan belum dikirim ke email)."
        );
    }

    /**
     * BONUS: route parameter -> /hello/{nama}
     */
    public function hello(string $nama): View
    {
        $sapaan = [
            'nama'  => ucwords($nama),
            'waktu' => now()->translatedFormat('l, d F Y H:i'),
        ];

        return view('hello', [
            'sapaan' => $sapaan,
        ]);
    }
}
