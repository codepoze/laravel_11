<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama'    => 'Palet',
                'inisial' => 'P',
                'aktif'   => 'y',
            ],
            [
                'nama'    => 'Curah',
                'inisial' => 'C',
                'aktif'   => 'y',
            ]
        ];

        foreach ($data as $row) {
            DB::table('metode')->insert($row);
        }
    }
}
