<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** Validasi formulir kontak (field sama dengan form di landing page asli). */
class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'          => ['required', 'string', 'max:100'],
            'email'         => ['required', 'email', 'max:150'],
            'tanggal_pesan' => ['required', 'date'],
            'ketertarikan'  => ['required', 'integer', 'between:1,5'],
            'warna_tema'    => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'          => 'Nama wajib diisi.',
            'email.required'         => 'Alamat email wajib diisi.',
            'email.email'            => 'Format email tidak valid.',
            'tanggal_pesan.required' => 'Tanggal pengisian wajib diisi.',
            'tanggal_pesan.date'     => 'Tanggal tidak valid.',
            'ketertarikan.between'   => 'Tingkat ketertarikan harus antara 1 sampai 5.',
            'warna_tema.regex'       => 'Warna harus berformat heksadesimal, contoh #6699ff.',
        ];
    }
}
