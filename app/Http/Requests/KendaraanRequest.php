<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class KendaraanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'no_pol' => 'required|unique:kendaraan,no_pol,' . $this->id_kendaraan . ',id_kendaraan',
            'jenis'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'no_pol.required' => 'No Polisi Wajib Diisi!',
            'no_pol.unique'   => 'No Polisi Sudah Ada!',
            'jenis.required'  => 'Jenis Wajib Diisi!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = ['title'  => 'Gagal!', 'text'   => 'Data gagal ditambahkan!', 'type'   => 'error', 'button' => 'Okay!', 'class'  => 'danger', 'errors' => $validator->errors()];

        throw new HttpResponseException(Response::json($response));
    }
}
