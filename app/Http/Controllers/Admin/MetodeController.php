<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MetodeRequest;
use App\Libraries\Template;
use App\Models\Metode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class MetodeController extends Controller
{
    public function index()
    {
        return Template::load('admin', 'Metode', 'metode', 'view');
    }

    public function list()
    {
        $data = Metode::latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('aktif', function ($row) {
                $status = ($row->aktif == 'y') ? '<i data-feather="check"></i>&nbsp;<span>Aktif</span>' : '<i data-feather="x"></i>&nbsp;<span>Tidak Aktif</span>';
                $button = ($row->aktif == 'y') ? 'btn-relief-success' : 'btn-relief-danger';

                return '
                    <button type="button" id="btn-aktif" data-id="' . my_encrypt($row->id_metode) . '" class="btn btn-sm ' . $button . '">' . $status . '</button>
                ';
            })
            ->addColumn('action', function ($row) {
                return '
                    <button type="button" id="upd" data-id="' . my_encrypt($row->id_metode) . '" class="btn btn-sm btn-action btn-relief-primary" data-bs-toggle="modal" data-bs-target="#modal-add-upd"><i data-feather="edit"></i>&nbsp;<span>Ubah</span></button>&nbsp;
                    <button type="button" id="del" data-id="' . my_encrypt($row->id_metode) . '" class="btn btn-sm btn-action btn-relief-danger"><i data-feather="trash"></i>&nbsp;<span>Hapus</span></button>
                ';
            })
            ->rawColumns(['aktif', 'action'])
            ->make(true);
    }

    public function all()
    {
        $response = Metode::select('id_metode AS id', 'nama AS text')->orderBy('id_metode', 'desc')->get();

        return Response::json($response);
    }

    public function show(Request $request)
    {
        $response = Metode::find(my_decrypt($request->id));

        return Response::json($response);
    }

    public function save(MetodeRequest $request)
    {
        try {
            Metode::updateOrCreate(
                [
                    'id_metode' => $request->id_metode,
                ],
                [
                    'nama'    => $request->nama,
                    'inisial' => get_inisial($request->nama),
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
                $data = Metode::find(my_decrypt($request->id));

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

    public function aktif(Request $request)
    {
        try {
            $data = Metode::find(my_decrypt($request->id));
            $data->aktif = ($data->aktif == 'y') ? 'n' : 'y';
            $data->save();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }
}
