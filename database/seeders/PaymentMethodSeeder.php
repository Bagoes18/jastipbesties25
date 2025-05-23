<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bannerRecords = [
            [
                'name' => 'Bank BCA',
                'nomor' => '1234567890',
                'atas_nama' => 'PT. Contoh Shop',
            ],
            [
                'name' => 'Bank BRI',
                'nomor' => '1234567890',
                'atas_nama' => 'PT. Contoh Shop',
            ],
            [
                'name' => 'Bank BNI',
                'nomor' => '1234567890',
                'atas_nama' => 'PT. Contoh Shop',
            ],
        ];

        PaymentMethod::insert($bannerRecords);
    }
}
