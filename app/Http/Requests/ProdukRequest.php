<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class ProdukRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_satuan' => 'required',
            'nama'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_satuan.required' => 'Satuan harus diisi!',
            'nama.required'      => 'Nama harus diisi!',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = ['title'  => 'Gagal!', 'text'   => 'Data gagal ditambahkan!', 'type'   => 'error', 'button' => 'Okay!', 'class'  => 'danger', 'errors' => $validator->errors()];

        throw new HttpResponseException(Response::json($response));
    }
}
