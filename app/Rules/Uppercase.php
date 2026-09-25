<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Uppercase implements ValidationRule
{
    /**
     * Jalankan validasi: menolak angka dan mewajibkan huruf kapital semua.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // 1. Cek keberadaan angka
        if (preg_match('/[0-9]/', $value)) {
            $fail('Kolom :attribute tidak boleh mengandung karakter angka.');
            return;
        }

        // 2. Cek apakah string berupa huruf kapital/besar
        if (strtoupper($value) !== $value) {
            $fail('Kolom :attribute wajib menggunakan HURUF BESAR/KAPITAL semua.');
        }
    }
}
