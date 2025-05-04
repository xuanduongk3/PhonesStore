<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Banner;
class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $banners = [
            [
                'title' => 'Banner 1',
                'image' => 'banner-apple.png'
            ],
            [
                'title' => 'Banner 2',
                'image' => 'banner-samsung.png'
            ],
            [
                'title' => 'Banner 3',
                'image' => 'banner-laptop.png'
            ]
        ];

        foreach ($banners as $banner) {
            Banner::create($banner);
        }
    }
}
