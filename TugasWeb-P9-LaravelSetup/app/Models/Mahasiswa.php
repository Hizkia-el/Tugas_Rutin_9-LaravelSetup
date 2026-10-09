<?php

// ====================================================================
// app/Models/Mahasiswa.php
// Dibuat dengan: php artisan make:model Mahasiswa -m
// REQUIREMENT 6: pemakaian make:model -m (model + migration sekaligus).
// ====================================================================

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'github',
    ];
}
