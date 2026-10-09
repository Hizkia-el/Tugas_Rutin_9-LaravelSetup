<?php

// ====================================================================
// routes/web.php
// REQUIREMENT 3: route default "/" (welcome page bawaan Laravel,
//                di-screenshot dulu sebelum di-custom — lihat README).
// REQUIREMENT 4: 3 route custom (/, /about, /contact) yang masing-masing
//                mengembalikan Blade view.
// REQUIREMENT 5: data dinamis dikirim sebagai array dari route/controller
//                ke view (bukan hardcode di Blade).
// BONUS: route parameter /hello/{nama}
// ====================================================================

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Catatan: route "/" awalnya `return view('welcome')` bawaan Laravel
// (dipakai untuk screenshot bukti instalasi di REQUIREMENT 3).
// Setelah itu di-ganti ke HomeController supaya memenuhi REQUIREMENT 4 & 5.
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Kirim formulir kontak (validasi lewat ContactRequest, @csrf wajib di form)
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');

// BONUS: route parameter dinamis -> /hello/budi, /hello/siti, dst.
Route::get('/hello/{nama}', [HomeController::class, 'hello'])->name('hello');
