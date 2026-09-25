<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Uppercase;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50', new Uppercase],
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama lengkap wajib diisi!',
            'name.min' => 'Nama minimal terdiri dari 3 karakter!',
            'email.required' => 'Alamat email wajib diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 6 karakter!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ];
    }
}
