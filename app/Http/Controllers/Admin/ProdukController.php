<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukRequest;
use App\Libraries\Template;
use App\Models\Produk;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class ProdukController extends Controller
{
    public function index()
    {
        $satuan = Satuan::all();

        $data = [
            'satuan' => $satuan
        ];

        return Template::load('admin', 'Produk', 'produk', 'view', $data);
    }

    public function list()
    {
        $data = Produk::with(['toSatuan'])->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_produk) . '" class="btn btn-sm btn-action btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_produk) . '" class="btn btn-sm btn-action btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->make(true);
    }

    public function show(Request $request)
    {
        $response = Produk::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(ProdukRequest $request)
    {
        try {
            Produk::updateOrCreate(
                [
                    'id_produk' => $request->id_produk,
                ],
                [
                    'id_satuan' => $request->id_satuan,
                    'nama'      => $request->nama,
                    'tipe'      => $request->tipe,
                    'deskripsi' => $request->deskripsi,
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
        $checking = is_valid_user($this->session->id, $request->password);
        if ($checking) {
            try {
                $data = Produk::find(my_decrypt($request->id));

                $data->delete();

                $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Hapus!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
            } catch (\Exception $e) {
                $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Hapus!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
            }
        } else {
            $response = ['title' => 'Maaf!', 'text' => 'Password Anda Salah!', 'type' => 'warning', 'button' => 'Ok!', 'class' => 'warning'];
        }
        return Response::json($response);
    }
}
