<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Điện thoại', 'slug' => 'dien-thoai', 'icon' => 'fas fa-mobile-alt'],
            ['name' => 'Laptop', 'slug' => 'laptop', 'icon' => 'fas fa-laptop'],
            ['name' => 'Tai nghe', 'slug' => 'tai-nghe', 'icon' => 'fas fa-headphones-alt'],
            ['name' => 'Smartwatch', 'slug' => 'smartwatch', 'icon' => 'fas fa-clock'],
            ['name' => 'Tablet', 'slug' => 'tablet', 'icon' => 'fas fa-tablet-alt'],
            ['name' => 'Sạc cáp', 'slug' => 'sac-cap', 'icon' => 'fas fa-plug'],
        ];
    
        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
