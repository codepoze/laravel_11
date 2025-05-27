<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\KendaraanRequest;
use App\Libraries\Template;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class KendaraanController extends Controller
{
    public function index()
    {
        return Template::load('admin', 'Kendaraan', 'kendaraan', 'view');
    }

    public function list()
    {
        $data = Kendaraan::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('jenis', function ($row) {
                return ucfirst($row->jenis);
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_kendaraan) . '" class="btn btn-sm btn-action btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_kendaraan) . '" class="btn btn-sm btn-action btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function all()
    {
        $response = Kendaraan::select('id_kendaraan AS id', 'no_pol AS text')->orderBy('id_kendaraan', 'desc')->get();

        return Response::json($response);
    }

    public function show(Request $request)
    {
        $response = Kendaraan::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(KendaraanRequest $request)
    {
        try {
            Kendaraan::updateOrCreate(
                [
                    'id_kendaraan' => $request->id_kendaraan,
                ],
                [
                    'no_pol' => $request->no_pol,
                    'jenis'  => $request->jenis,
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
                $data = Kendaraan::find(my_decrypt($request->id));

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
