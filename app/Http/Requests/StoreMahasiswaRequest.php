<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMahasiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'users_id' => 'required|exists:users,id',
            'id_prodi' => 'required|exists:program_studi,id',
            'nim' => ['required', 'string', 'max:20', 'unique:mahasiswa,nim'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'angkatan' => ['required', 'integer'],
            'status' => ['nullable', 'in:aktif,non-aktif,lulus'],
        ];
    }

    public function messages(): array
    {
        return [
            'users_id.required' => 'User wajib diisi.',
            'users_id.exists' => 'User tidak valid.',
            'id_prodi.exists' => 'Program Studi tidak valid.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'nama.required' => 'Nama wajib diisi.',
            'angkatan.required' => 'Angkatan wajib diisi.',
            'status.in' => 'Status harus salah satu dari: aktif, non-aktif, atau lulus.',
        ];
    }
}
