<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendaftaranRequest;
use App\Libraries\Pdf;
use App\Libraries\Template;
use App\Models\Antrean;
use App\Models\Pendaftaran;
use App\Models\PendaftaranProduk;
use App\Models\Produk;
use App\Models\TPendaftaranProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\Facades\DataTables;

class PendaftaranController extends Controller
{
    public function index()
    {
        return Template::load('admin', 'Pendaftaran', 'pendaftaran', 'view');
    }

    public function create()
    {
        $produk = Produk::all();

        $data = [
            'produk' => $produk,
        ];

        return Template::load('admin', 'Tambah', 'pendaftaran', 'create', $data);
    }

    public function detail($id)
    {
        $id = my_decrypt($id);

        $data = [
            'pendataran' => Pendaftaran::with(['toKendaraan', 'toMetode', 'toAntrean'])->find($id),
        ];

        return Template::load('admin', 'Detail', 'pendaftaran', 'detail', $data);
    }

    public function list()
    {
        $data = Pendaftaran::with(['toKendaraan', 'toMetode'])->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($row) {
                return tgl_indo($row->created_at);
            })
            ->addColumn('jam', function ($row) {
                return get_waktu($row->created_at);
            })
            ->addColumn('status', function ($row) {
                if ($row->approved == 'm') {
                    return '<span class="badge bg-warning">Menunggu</span>';
                } elseif ($row->approved == 'y') {
                    return '<span class="badge bg-success">Disetujui</span>';
                } elseif ($row->approved == 'n') {
                    return '<span class="badge bg-danger">Ditolak</span>';
                }
            })
            ->addColumn('approved', function ($row) {
                if ($row->approved == 'm') {
                    return '
                        <button type="button" id="btn-approve" data-id="' . my_encrypt($row->id_pendaftaran) . '" data-approve="y" class="btn btn-sm btn-action btn-relief-success"><i data-feather="check"></i>&nbsp;<span>Disetujui</span></button>&nbsp;
                        <button type="button" id="btn-approve" data-id="' . my_encrypt($row->id_pendaftaran) . '" data-approve="n" class="btn btn-sm btn-action btn-relief-danger"><i data-feather="x"></i>&nbsp;<span>Ditolak</span></button>
                    ';
                } else {
                    if ($row->approved == 'y') {
                        return '<span class="badge bg-success">Disetujui</span>';
                    } elseif ($row->approved == 'n') {
                        return '<span class="badge bg-danger">Ditolak</span>';
                    }
                }
            })
            ->addColumn('action', function ($row) {
                if ($row->approved == 'y') {
                    return '
                        <a href="' . route('admin.pendaftaran.detail', my_encrypt($row->id_pendaftaran)) . '" class="btn btn-sm btn-action btn-relief-primary"><i data-feather="eye"></i>&nbsp;<span>Detail</span></a>&nbsp;    
                        <a href="' . route('admin.pendaftaran.print', my_encrypt($row->id_pendaftaran)) . '" class="btn btn-sm btn-action btn-relief-success"><i data-feather="printer"></i>&nbsp;<span>Cetak</span></a>
                    ';
                } else {
                    return '<a href="' . route('admin.pendaftaran.detail', my_encrypt($row->id_pendaftaran)) . '" class="btn btn-sm btn-action btn-relief-primary"><i data-feather="eye"></i>&nbsp;<span>Detail</span></a>';
                }
            })
            ->rawColumns(['status', 'approved', 'action'])
            ->make(true);
    }

    public function save(PendaftaranRequest $request)
    {
        DB::beginTransaction();

        try {
            $pendataran               = new Pendaftaran();
            $pendataran->id_kendaraan = $request->id_kendaraan;
            $pendataran->id_metode    = $request->id_metode;
            $pendataran->no_so        = $request->no_so;
            $pendataran->distributor  = $request->distributor;
            $pendataran->nama         = $request->nama;
            $pendataran->tujuan       = $request->tujuan;
            $pendataran->no_hp        = $request->no_hp;
            $pendataran->no_identitas = $request->no_identitas;
            $pendataran->save();

            $t_pendaftaran_produk = TPendaftaranProduk::all();

            foreach ($t_pendaftaran_produk as $key => $value) {
                $pendaftaran_produk = new PendaftaranProduk();
                $pendaftaran_produk->id_pendaftaran = $pendataran->id_pendaftaran;
                $pendaftaran_produk->id_produk      = $value->id_produk;
                $pendaftaran_produk->qty            = $value->qty;
                $pendaftaran_produk->palet          = $value->palet;
                $pendaftaran_produk->remark         = $value->remark;
                $pendaftaran_produk->save();

                $value->delete();
            }

            DB::commit();

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Simpan!', 'type' => 'success', 'button' => 'Okay!', 'class' => 'success', 'url' => route('admin.pendaftaran.detail', my_encrypt($pendataran->id_pendaftaran))];
        } catch (\Exception $e) {
            DB::rollBack();

            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Simpan!', 'type' => 'error', 'button' => 'Okay!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function approved(Request $request)
    {
        try {
            $data = Pendaftaran::find(my_decrypt($request->id));
            $data->approved = $request->approved;
            $data->save();

            if ($request->approved == 'y') {
                $no_antrean = $this->generateNoAntrean($request->id);

                $antrean = new Antrean();
                $antrean->id_pendaftaran = my_decrypt($request->id);
                $antrean->no_antrean     = $no_antrean;
                $antrean->save();
            }

            $response = ['title' => 'Berhasil!', 'text' => 'Data Sukses di Ubah!', 'type' => 'success', 'button' => 'Ok!', 'class' => 'success'];
        } catch (\Exception $e) {
            $response = ['title' => 'Gagal!', 'text' => 'Data Gagal di Ubah!', 'type' => 'error', 'button' => 'Ok!', 'class' => 'danger'];
        }

        return Response::json($response);
    }

    public function print($id)
    {
        $id = my_decrypt($id);

        $data = [
            'pendaftaran' => Pendaftaran::with(['toKendaraan', 'toMetode', 'toAntrean', 'toPendaftaranProduk'])->find($id),
        ];

        return Pdf::printPdf('Pendaftaran', 'admin.pendaftaran.print', 'A4', 'potrait', $data);
    }

    private function generateNoAntrean($id)
    {
        $pendaftaran = Pendaftaran::with(['toMetode'])->find(my_decrypt($id));
        $inisial     = $pendaftaran->toMetode->inisial;
        $today       = Carbon::today()->toDateString();

        $antrean = Pendaftaran::where('id_metode', $pendaftaran->id_metode)->where('approved', 'y')->where('created_at', '>=', $today . ' 00:00:00')->count();

        if ($antrean == 0) {
            $newNumber = 1;
        } else {
            $newNumber = $antrean;
        }

        $no_antrean = $inisial . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $no_antrean;
    }
}
