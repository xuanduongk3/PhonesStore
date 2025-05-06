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
            ['name' => 'Realme', 'logo' => 'realme.jpg'],
            ['name' => 'Vivo', 'logo' => 'vivo.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
