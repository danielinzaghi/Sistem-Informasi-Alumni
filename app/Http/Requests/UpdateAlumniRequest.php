<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlumniRequest extends FormRequest
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
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'tahun_lulus' => 'required|integer|min:2000|max:' . date('Y'),
            'pekerjaan' => 'nullable|string|max:100',
            'instansi' => 'nullable|string|max:100',
            'npwp' => 'nullable|numeric|digits:15',
            'nik' => 'nullable|numeric|digits:16',
        ];
    }
}
