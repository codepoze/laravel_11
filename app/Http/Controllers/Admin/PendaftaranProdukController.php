<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendaftaranProduk;
use Yajra\DataTables\Facades\DataTables;

class PendaftaranProdukController extends Controller
{
    public function list($id)
    {
        $id = my_decrypt($id);

        $data = PendaftaranProduk::with(['toProduk.toSatuan'])->where('id_pendaftaran', $id)->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}
