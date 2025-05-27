<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Kubik'
            ]
        ];

        foreach ($data as $row) {
            DB::table('satuan')->insert($row);
        }
    }
}
