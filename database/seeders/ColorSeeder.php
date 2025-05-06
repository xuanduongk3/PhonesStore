<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;
class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'black', 'title' => 'Đen' , 'hex_code' => '#3C4042'],
            ['name' => 'pink', 'title' => 'Hồng' , 'hex_code' => '#F2ADDA'],
            ['name' => 'ultramarine', 'title' => 'Xanh lưu ly' , 'hex_code' => '#3f00ff'],
            ['name' => 'white', 'title' => 'Trắng' , 'hex_code' => '#FAFAFA'],
            ['name' => 'black_titan', 'title' => 'Titan đen' , 'hex_code' => '#3F4042'],
            ['name' => 'desert_titan', 'title' => 'Titan sa mạc', 'hex_code' => '#C4AB97'],
            ['name' => 'natural_titan', 'title' => 'Titan tự nhiên', 'hex_code' => '#BAB4A9'],
            ['name' => 'white_titan', 'title' => 'Titan trắng', 'hex_code' => '#F2F1EB'],
            ['name' => 'gray', 'title' => 'Xám' , 'hex_code' => '#808080'],
            ['name' => 'green', 'title' => 'Xanh lá', 'hex_code' => '#008000'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
