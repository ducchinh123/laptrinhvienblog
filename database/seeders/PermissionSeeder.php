<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = [
            0 => [
                'id' => 1,
                'name' => 'add category',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            1 => [
                'id' => 2,
                'name' => 'edit category',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            2 => [
                'id' => 3,
                'name' => 'delete category',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            3 => [
                'id' => 4,
                'name' => 'add post',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            4 => [
                'id' => 5,
                'name' => 'edit post',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            5 => [
                'id' => 6,
                'name' => 'delete post',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            6 => [
                'id' => 7,
                'name' => 'add video',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            7 => [
                'id' => 8,
                'name' => 'edit video',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            8 => [
                'id' => 9,
                'name' => 'delete video',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ],
            9 => [
                'id' => 10,
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        $insertPermission = DB::table('permissions')->insert($data);
    }
}
