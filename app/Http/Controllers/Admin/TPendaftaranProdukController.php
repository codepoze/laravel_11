<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TPendaftaranProdukRequest;
use App\Models\TPendaftaranProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class TPendaftaranProdukController extends Controller
{
    public function list()
    {
        $data = TPendaftaranProduk::with(['toProduk.toSatuan'])->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd-t_pendaftaran_produk" data-id="' . my_encrypt($row->id_t_pendaftaran_produk) . '" class="btn btn-sm btn-action btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-t_pendaftaran_produk"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del-t_pendaftaran_produk" data-id="' . my_encrypt($row->id_t_pendaftaran_produk) . '" class="btn btn-sm btn-action btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $response = TPendaftaranProduk::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(TPendaftaranProdukRequest $request)
    {
        try {
            TPendaftaranProduk::updateOrCreate(
                [
                    'id_t_pendaftaran_produk' => $request->id_t_pendaftaran_produk,
                ],
                [
                    'id_pendaftaran' => $request->id_pendaftaran,
                    'id_produk'      => $request->id_produk,
                    'qty'            => $request->qty,
                    'palet'          => $request->palet,
                    'remark'         => $request->remark,
                ]
            );

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Simpan!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Simpan!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function del(Request $request)
    {
        try {
            $data = TPendaftaranProduk::find(my_decrypt($request->id));

            $data->delete();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Hapus!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
        }

        return Response::json($response);
    }
}
