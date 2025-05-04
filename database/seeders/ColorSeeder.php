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
            ['name' => 'black', 'hex_code' => '#000000'],
            ['name' => 'pink', 'hex_code' => '#ffc0cb'],
            ['name' => 'ultramarine', 'hex_code' => '#3f00ff'],
            ['name' => 'white', 'hex_code' => '#ffffff'],
            ['name' => 'black_titan', 'hex_code' => '#1c1c1e'],
            ['name' => 'desert_titan', 'hex_code' => '#c9bca7'],
            ['name' => 'natural_titan', 'hex_code' => '#d6d0c4'],
            ['name' => 'white_titan', 'hex_code' => '#f9f9f9'],
            ['name' => 'gray', 'hex_code' => '#808080'],
            ['name' => 'green', 'hex_code' => '#008000'],
        ];

        foreach ($colors as $color) {
            Color::create($color);
        }
    }
}
