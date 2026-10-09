# Tugas Rutin 9 — Setup Laravel

Project Laravel untuk latihan setup awal: install lewat Composer, koneksi ke
MySQL, route custom, Blade view dengan data dinamis, serta Controller & Model
(dengan migration).

> **Catatan jujur:** file-file di folder ini (routes, controller, model,
> migration, seeder, view) adalah *bagian custom* yang perlu digabungkan ke
> project Laravel yang kamu buat sendiri lewat `composer create-project` —
> karena instalasi Laravel (download `vendor/` dkk) harus jalan di komputermu
> yang punya akses internet ke Packagist, bukan di sini. Ikuti langkah di
> bawah, urutannya sudah dipastikan sesuai rubrik.

## Struktur folder (yang disiapkan di sini)

```
├── routes/
│   └── web.php                           -> 3 route custom + 1 route bonus
├── app/
│   ├── Http/
│   │   ├── Controllers/HomeController.php -> dibuat via make:controller
│   │   └── Requests/ContactRequest.php    -> validasi formulir kontak
│   └── Models/
│       └── Mahasiswa.php                 -> dibuat via make:model -m
├── database/
│   ├── migrations/
│   │   └── ..._create_mahasiswas_table.php  -> migration dari make:model -m
│   └── seeders/
│       ├── MahasiswaSeeder.php           -> seed 1 data (Yobel Hizkia Sijabat)
│       └── DatabaseSeeder.php            -> sudah dipanggil MahasiswaSeeder
├── resources/views/
│   ├── layouts/app.blade.php             -> layout bersama + tema langit malam
│   ├── home.blade.php                    -> view "/"
│   ├── about.blade.php                   -> view "/about"
│   ├── contact.blade.php                 -> view "/contact"
│   └── hello.blade.php                   -> view bonus "/hello/{nama}"
├── public/
│   ├── css/style.css                     -> style tema langit malam (CSS terpisah)
│   └── images/foto-yobel.jpg             -> foto profil di beranda
└── .env.example                          -> contoh konfigurasi koneksi MySQL
```

## Langkah instalasi (urutan penting, ikuti dari atas)

### 1. Install Composer

Download & install dari [getcomposer.org](https://getcomposer.org/download/).
Cek sudah terpasang:

```bash
composer -V
```

### 2. Buat project Laravel baru

**REQUIREMENT 1** — jalankan di folder tempat kamu mau menyimpan project:

```bash
composer create-project laravel/laravel TugasWeb-P9-LaravelSetup
cd TugasWeb-P9-LaravelSetup
```

Tunggu sampai selesai (download `vendor/`, generate `.env`, generate
`APP_KEY` otomatis).

### 3. Jalankan dulu & screenshot welcome page bawaan

**REQUIREMENT 3** — sebelum file-file custom ditimpa, buktikan dulu instalasi
berhasil:

```bash
php artisan serve
```

Buka `http://127.0.0.1:8000` di browser → akan muncul halaman **Welcome**
bawaan Laravel. **Screenshot halaman ini** untuk dilampirkan sebagai bukti
instalasi (poin ini memang harus kamu lakukan sendiri di komputermu, karena
tangkapan layarnya harus dari environment kamu).

Matikan server dulu (`Ctrl+C`) sebelum lanjut ke langkah berikutnya.

### 4. Timpa dengan file-file custom dari folder ini

Salin (copy-paste, timpa kalau sudah ada) folder/file berikut dari paket yang
saya kirim, ke dalam folder project Laravel yang baru dibuat:

- `routes/web.php`
- `app/Http/Controllers/HomeController.php`
- `app/Http/Requests/ContactRequest.php`
- `app/Models/Mahasiswa.php`
- `database/migrations/2026_01_01_000010_create_mahasiswas_table.php`
- `database/seeders/MahasiswaSeeder.php`
- `database/seeders/DatabaseSeeder.php` (timpa yang bawaan)
- `resources/views/layouts/app.blade.php`
- `resources/views/home.blade.php`
- `resources/views/about.blade.php`
- `resources/views/contact.blade.php`
- `resources/views/hello.blade.php`
- `public/css/style.css` dan `public/images/foto-yobel.jpg` (salin ke folder `public/` project)

> Supaya kamu paham command yang sebenarnya dipakai untuk menghasilkan file
> ini (walau sudah saya tulis manual isinya), command aslinya adalah:
> ```bash
> php artisan make:controller HomeController
> php artisan make:model Mahasiswa -m
> ```
> (`-m` artinya sekaligus membuat file migration-nya — **REQUIREMENT 6**)

### 5. Buat database di phpMyAdmin

**REQUIREMENT 2** — buka phpMyAdmin (biasanya lewat XAMPP/Laragon), buat
database baru bernama `tugas9_laravel` (collation `utf8mb4_unicode_ci`).

### 6. Konfigurasi `.env`

Buka file `.env` di root project (sudah otomatis dibuat di Langkah 2), ubah
bagian koneksi database jadi seperti ini (contoh ada di `.env.example` pada
paket ini):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tugas9_laravel
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan `DB_USERNAME` / `DB_PASSWORD` dengan setting MySQL kamu (default
XAMPP/Laragon biasanya `root` tanpa password).

### 7. Jalankan migration + seeder

```bash
php artisan migrate --seed
```

Ini akan membuat semua tabel (termasuk `mahasiswas` dari `make:model -m`) dan
mengisi 5 data contoh mahasiswa.

### 8. Jalankan ulang server

```bash
php artisan serve
```

Buka:
- `http://127.0.0.1:8000/` → beranda (data profil & menu, dari array di controller)
- `http://127.0.0.1:8000/about` → tentang + tabel data mahasiswa dari database
- `http://127.0.0.1:8000/contact` → info kontak
- `http://127.0.0.1:8000/hello/budi` → **bonus**, route parameter

## Ketentuan yang dipenuhi

| # | Ketentuan | Lokasi |
|---|---|---|
| 1 | Install Composer & `composer create-project` | Langkah 2 di atas (dilakukan di komputermu) |
| 2 | Buat DB di phpMyAdmin & konfigurasi `.env` (mysql) | Langkah 5 & 6, `.env.example` |
| 3 | `artisan serve` jalan + screenshot welcome page | Langkah 3 (screenshot diambil sendiri) |
| 4 | 3 route custom (`/`, `/about`, `/contact`) return Blade view | `routes/web.php` → `HomeController` |
| 5 | View menampilkan data dinamis (array dari route) | `home.blade.php`, `about.blade.php`, `contact.blade.php` — semua pakai `@foreach`/variabel dari controller, bukan hardcode |
| 6 | `make:controller` & `make:model -m` minimal 1x | `HomeController.php` + `Mahasiswa.php` & migration `create_mahasiswas_table.php` |
| 7 | README: langkah install + struktur folder | Dokumen ini |
| 8 | Repo: `TugasWeb-P9-LaravelSetup` | Nama folder/project di Langkah 2 & petunjuk push di bawah |

**Bonus (keduanya dikerjakan):**
- **Styling CSS terpisah** — `layouts/app.blade.php` memuat `public/css/style.css` lewat `asset('css/style.css')` (tema langit malam: bintang, meteor, kartu kaca). Tailwind CDN tidak lagi dipakai.
- **Route parameter** — `/hello/{nama}` di `routes/web.php`, ditangani `HomeController@hello`, tampil di `hello.blade.php`

## Cara push ke GitHub

```bash
cd TugasWeb-P9-LaravelSetup
git init
git add .
git commit -m "Tugas Rutin 9: Setup Laravel"
git branch -M main
git remote add origin https://github.com/username/TugasWeb-P9-LaravelSetup.git
git push -u origin main
```

**Catatan:** `.env` (bukan `.env.example`) berisi `APP_KEY` dan kredensial
database asli — file ini sudah otomatis di-ignore oleh `.gitignore` bawaan
Laravel, jadi **jangan** dipaksa di-commit supaya kredensial tidak ikut
terunggah ke repo publik.
