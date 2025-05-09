<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductsAttribute;

class ProductsAttributesTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ProductsAttributeRecords = [
            [
                "id" => 1,
                "product_id" => 1,
                "size" => "Small",
                "sku" => "BT001S",
                "price" => 100000,
                "stock" => 100,
                "status" => 1,
            ],
            [
                "id" => 2,
                "product_id" => 1,
                "size" => "Medium",
                "sku" => "BT001M",
                "price" => 100000,
                "stock" => 50,
                "status" => 1,
            ],
            [
                "id" => 3,
                "product_id" => 1,
                "size" => "Large",
                "sku" => "BT001L",
                "price" => 105000,
                "stock" => 20,
                "status" => 1,
            ],
            [
                "id" => 4,
                "product_id" => 1,
                "size" => "Extra Large",
                "sku" => "BT001XL",
                "price" => 110000,
                "stock" => 60,
                "status" => 1,
            ],

        ];
        ProductsAttribute::insert($ProductsAttributeRecords);
    }
}
