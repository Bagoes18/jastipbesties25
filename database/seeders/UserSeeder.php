<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('111111'),
            'telepon' => '081234578123',
            'alamat' => 'Jl. Raya Gambir No. 1, Jakarta Selatan, Indonesia',
        ]);
    }
}
