<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456');
        $adminRecords = [
            ['id'   => 2,
             'name' => 'Bagus',
             'type' => 'admin',
             'mobile' => '085858676987',
             'email' => 'bagus@gmail.com',
             'password' => $password,
             'image' => '',
             'status' => 1],
            ['id'   => 3,
             'name' => 'Ridwan',
             'type' => 'admin',
             'mobile' => '0858586767678',
             'email' => 'ridwan@gmail.com',
             'password' => $password,
             'image' => '',
             'status' => 1],
        ];
        Admin::insert($adminRecords);
    }
}
