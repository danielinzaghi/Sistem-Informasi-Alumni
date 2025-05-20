<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMahasiswaRequest extends FormRequest
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
            'users_id' => 'sometimes|exists:users,id',
            'id_prodi' => 'sometimes|exists:program_studi,id',
            'nim' => ['sometimes', 'string', 'max:20'],
            'no_hp' => ['nullable', 'string', 'max:20'],
            'angkatan' => ['sometimes', 'integer'],
            'status' => ['nullable', 'in:aktif,non-aktif,lulus'],
        ];
    }
}
