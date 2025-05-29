<?php

namespace App\Http\Controllers\Admin;

use App\Events\CallTheQueue;
use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Antrean;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class AntreanController extends Controller
{
    public function index()
    {
        return Template::load('admin', 'Antrean', 'antrean', 'view');
    }

    public function list(Request $request)
    {
        if (isset($request->from) && isset($request->to)) {
            $from = $request->from;
            $to   = $request->to;
        } else {
            $date = Carbon::now();
            $from = $date->format('Y-m-d');
            $to   = $date->format('Y-m-d');
        }

        $data = Antrean::with(['toPendaftaran.toKendaraan', 'toPendaftaran.toMetode'])->whereBetween('created_at', [$from, $to])->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($row) {
                return tgl_indo($row->toPendaftaran->created_at);
            })
            ->addColumn('jam', function ($row) {
                return get_waktu($row->toPendaftaran->created_at);
            })
            ->addColumn('panggil', function ($row) {
                if ($row->status === 'menunggu') {
                    return '
                        <button type="button" id="btn-panggil" data-id="' . my_encrypt($row->id_antrean) . '" data-no_antrean="' . $row->no_antrean . '" class="btn btn-sm btn-action btn-relief-primary"><i data-feather="info"></i>&nbsp;<span>Panggil</span></button>
                    ';
                } else {
                    return '
                        <button type="button" id="btn-panggil" data-id="' . my_encrypt($row->id_antrean) . '" data-no_antrean="' . $row->no_antrean . '" class="btn btn-sm btn-action btn-relief-primary"><i data-feather="check"></i>&nbsp;<span>Dipanggil</span></button>
                    ';
                }
            })
            ->rawColumns(['panggil'])
            ->make(true);
    }

    public function memanggil(Request $request)
    {
        try {
            $id = my_decrypt($request->id);

            CallTheQueue::dispatch();

            $data = Antrean::find($id);
            $data->status = 'memanggil';
            $data->save();

            $response = ['status' => true, 'title' => 'Berhasil!', 'text' => 'Berhasil dipanggil!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['status' => false, 'title' => 'Gagal!', 'text' => 'Gagal dipanggil!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
        }

        return Response::json($response);
    }
}
