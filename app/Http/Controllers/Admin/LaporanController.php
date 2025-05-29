<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Template;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function antrean()
    {
        $date = Carbon::now();
        $from = $date->startOfMonth()->format('Y-m-d');
        $to   = $date->endOfMonth()->format('Y-m-d');

        $data = [
            'from' => $from,
            'to'   => $to,
        ];

        return Template::load('admin', 'Laporan', 'laporan/antrean', 'view', $data);
    }
}
