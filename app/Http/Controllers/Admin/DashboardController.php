<?php

namespace App\Http\Controllers\Admin;

use App\Libraries\Template;
use App\Http\Controllers\Controller;
use App\Models\Metode;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $metode = Metode::where('aktif', 'y')->get();

        $result = [];

        foreach ($metode as $row) {
            $count_antrean = DB::table('antrean as a')
                ->leftJoin('pendaftaran as p', 'p.id_pendaftaran', '=', 'a.id_pendaftaran')
                ->where('p.id_metode', $row->id_metode)
                ->where('a.status', 'memanggil')
                ->where('a.created_at', '>=', date('Y-m-d'))
                ->count();

            $result[] = [
                'nama'       => $row->nama,
                'no_antrean' => $count_antrean ?? 0,
            ];
        }

        $data = [
            'antrean' => $result,
        ];

        return Template::load('admin', 'Dashboard', 'dashboard', 'view', $data);
    }
}
