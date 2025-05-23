<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandRecords = [
            [
                "id" => 1,
                "brand_name" => "Arrow",
                "brand_image" => "",
                "brand_logo" => "",
                "brand_discount" => 0,
                "description" => "",
                "url" => "arrow",
                "meta_title" => "",
                "meta_description" => "",
                "meta_keywords" => "",
                "status" => 1,
            ],
            [
                "id" => 2,
                "brand_name" => "Zara",
                "brand_image" => "",
                "brand_logo" => "",
                "brand_discount" => 0,
                "description" => "",
                "url" => "zara",
                "meta_title" => "",
                "meta_description" => "",
                "meta_keywords" => "",
                "status" => 1,
            ],
            [
                "id" => 3,  
                "brand_name" => "H&M",
                "brand_image" => "",
                "brand_logo" => "",
                "brand_discount" => 0,
                "description" => "",
                "url" => "h&m",
                "meta_title" => "",
                "meta_description" => "",
                "meta_keywords" => "",
                "status" => 1,
            ],
            [
                "id" => 4,
                "brand_name" => "Levi's",
                "brand_image" => "",
                "brand_logo" => "",
                "brand_discount" => 0,
                "description" => "",
                "url" => "levi's",
                "meta_title" => "",
                "meta_description" => "",
                "meta_keywords" => "",
                "status" => 1,
            ],
            [
                "id" => 5,
                "brand_name" => "Klamby",
                "brand_image" => "",
                "brand_logo" => "",
                "brand_discount" => 0,
                "description" => "",
                "url" => "klamby",
                "meta_title" => "",
                "meta_description" => "",
                "meta_keywords" => "",
                "status" => 1,
            ],
        ];

        Brand::insert($brandRecords);
    }
}
