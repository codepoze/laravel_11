<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'       => 'agama-read',
                'guard_name' => 'web',
            ],
        ];

        foreach ($data as $row) {
            DB::table('permissions')->insert($row);
        }
    }
}
