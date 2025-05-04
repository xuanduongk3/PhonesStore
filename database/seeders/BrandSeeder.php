<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $brands = [
            ['name' => 'Apple', 'logo' => 'apple.png'],
            ['name' => 'Samsung', 'logo' => 'samsung.png'],
            ['name' => 'Xiaomi', 'logo' => 'xiaomi.png'],
            ['name' => 'Oppo', 'logo' => 'oppo.png'],
            ['name' => 'Realme', 'logo' => 'realme.png'],
            ['name' => 'Vivo', 'logo' => 'vivo.png'],
            ['name' => 'Asus', 'logo' => 'asus.png'],
            ['name' => 'HP', 'logo' => 'hp.png'],
            ['name' => 'Dell', 'logo' => 'dell.png'],
            ['name' => 'Lenovo', 'logo' => 'lenovo.png'],
            ['name' => 'MacBook', 'logo' => 'macbook.png'],
            ['name' => 'Anker', 'logo' => 'anker.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
