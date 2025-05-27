<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use App\Models\Metode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class DisplayController extends Controller
{
    public function index()
    {
        return Template::load('admin', 'Display', 'display', 'view');
    }

    public function list()
    {
        $metode = Metode::where('aktif', 'y')->get();

        $result = [];
        foreach ($metode as $row) {
            $no_antrean = DB::table('antrean as a')
                ->leftJoin('pendaftaran as p', 'p.id_pendaftaran', '=', 'a.id_pendaftaran')
                ->where('p.id_metode', $row->id_metode)
                ->where('a.status', 'memanggil')
                ->orderByDesc('a.updated_at')
                ->limit(1)
                ->value('a.no_antrean');

            $result[] = [
                'nama'       => $row->nama,
                'no_antrean' => $no_antrean ?? '-',
            ];
        }

        return Response::json($result);
    }
}
