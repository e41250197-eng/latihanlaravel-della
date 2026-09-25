<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Uppercase;

class FormValidationController extends Controller
{
    // Menampilkan form
    public function index()
    {
        return view('acara20');
    }

    // Memproses data dengan validasi dasar + custom rule Uppercase
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Nama lengkap wajib diisi!',
            'name.min' => 'Nama minimal 3 karakter!',
            'email.required' => 'Alamat email tidak boleh kosong!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ];

        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:50', new Uppercase],
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], $messages);

        return back()->with('success', 'Validasi Lengkap Berhasil! Nama: ' . $request->name);
    }
}
