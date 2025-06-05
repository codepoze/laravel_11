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
                'name'       => 'satuan-read',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'satuan-create',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'satuan-update',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'satuan-delete',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'produk-read',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'produk-create',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'produk-update',
                'guard_name' => 'web',
            ],
            [
                'name'       => 'produk-delete',
                'guard_name' => 'web',
            ],
        ];

        foreach ($data as $row) {
            DB::table('permissions')->insert($row);
        }
    }
}
