<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Response;

class PendaftaranRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_kendaraan'               => 'required',
            'id_metode'                  => 'required',
            'no_so'                      => 'required',
            'nama'                       => 'required',
            'no_hp'                      => 'required',
            'no_identitas'               => 'required',
            'count-t_pendaftaran_produk' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'id_kendaraan.required'               => 'Kendaraan wajib diisi',
            'id_metode.required'                  => 'Metode wajib diisi',
            'no_so.required'                      => 'No SO wajib diisi',
            'nama.required'                       => 'Nama wajib diisi',
            'no_hp.required'                      => 'No HP wajib diisi',
            'no_identitas.required'               => 'No Identitas wajib diisi',
            'count-t_pendaftaran_produk.required' => 'Pendaftaran Produk Wajib Diisi',
            'count-t_pendaftaran_produk.numeric'  => 'Pendaftaran Produk Harus Angka',
            'count-t_pendaftaran_produk.min'      => 'Pendaftaran Produk Minimal 1',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $response = ['title' => 'Gagal!', 'text' => 'Data gagal ditambahkan!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger', 'errors' => $validator->errors()];

        throw new HttpResponseException(Response::json($response));
    }
}
