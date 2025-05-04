<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Color;
use App\Models\Storage;
use App\Models\ProductSpecification;

class AppleSeeder extends Seeder
{
    public function run(): void
    {
        $brandId = 1; // Apple
        $categoryId = 1;

        $products = [
            ['name' => 'iPhone 16', 'slug' => 'iphone_16', 'thumbnail' => 'iphone_16.png', 'colors' => ['black', 'pink', 'ultramarine', 'white'], 'base_price' => 22990000, 'discount' => 10],
            ['name' => 'iPhone 16 Plus', 'slug' => 'iphone_16_plus', 'thumbnail' => 'iphone_16_plus.png', 'colors' => ['black', 'pink', 'ultramarine', 'white'], 'base_price' => 25990000, 'discount' => 5],
            ['name' => 'iPhone 16 Pro', 'slug' => 'iphone_16_pro', 'thumbnail' => 'iphone_16_pro.png', 'colors' => ['black_titan', 'desert_titan', 'natural_titan', 'white_titan'], 'base_price' => 28990000, 'discount' => 5],
            ['name' => 'iPhone 16 Pro Max', 'slug' => 'iphone_16_pro_max', 'thumbnail' => 'iphone_16_pro_max.png', 'colors' => ['black_titan', 'desert_titan', 'natural_titan', 'white_titan'], 'base_price' => 34990000, 'discount' => 5],
        ];

        $storages = Storage::whereIn('id', [1, 2, 3])->orderBy('id')->get();

        foreach ($products as $prod) {
            $product = Product::create([
                'name' => $prod['name'],
                'slug' => $prod['slug'],
                'description' => $prod['name'] . ' mô tả ngắn.',
                'long_description' => $prod['name'] . ' mô tả chi tiết.',
                'brand_id' => $brandId,
                'category_id' => $categoryId,
                'thumbnail' => $prod['thumbnail'],
            ]);

            $colors = Color::whereIn('name', $prod['colors'])->get();

            foreach ($colors as $color) {
                foreach ($storages as $index => $storage) {
                    $price = $prod['base_price'] + ($index * 2000000);

                    ProductVariant::create([
                        'product_id' => $product->id,
                        'color_id' => $color->id,
                        'storage_id' => $storage->id,
                        'price' => $price,
                        'discount' => $prod['discount'],
                        'stock' => rand(5, 20),
                        'image' => "{$prod['slug']}_{$color->name}.png",
                    ]);
                }
            }
            
            // Thêm specifications cho các sản phẩm
            $this->addSpecifications($product);
        }
    }
    
    private function addSpecifications($product)
    {
        $specifications = [];
        
        switch ($product->name) {
            case 'iPhone 16':
                $specifications = [
                    ['key' => 'Hệ điều hành', 'value' => 'iOS 18'],
                    ['key' => 'Màn hình', 'value' => "Super Retina XDR OLED, HDR10, Dolby Vision\n1000 nits (typ), 2000 nits (HBM)\n6.1 inches, 1179 x 2556 pixels\nTỷ lệ 19.5:9, Mật độ điểm ảnh ~461 ppi\nKính bảo vệ Ceramic Shield (2004)"],
                    ['key' => 'Thẻ sim', 'value' => 'Nano SIM và eSIM'],
                    ['key' => 'Chip xử lý (CPU)', 'value' => 'Apple A18 6 nhân'],
                    ['key' => 'Chip đồ họa (GPU)', 'value' => 'Apple GPU 5 nhân'],
                    ['key' => 'Bộ nhớ trong', 'value' => "128GB\n256GB\n512GB"],
                    ['key' => 'Camera sau', 'value' => "48 MP, f/1.6, 26mm (góc rộng), dual pixel PDAF, sensor-shift OIS\n12 MP, f/2.2, 13mm, 120˚ (góc siêu rộng), dual pixel PDAF\n\nQuay phim: 4K@24/25/30/60fps, 1080p@25/30/60/120/240fps, HDR, Dolby Vision HDR (up to 60fps), stereo sound rec."],
                    ['key' => 'Camera trước', 'value' => "12 MP, f/1.9, 23mm (góc rộng), PDAF\nSL 3D (độ sâu/cảm biến sinh trắc)\n\nQuay phim: 4K@24/25/30/60fps, 1080p@25/30/60/120fps, gyro-EIS"],
                    ['key' => 'Dung lượng pin', 'value' => "Li-Ion 3561 mAh\nSạc nhanh >20W\nSạc không dây 25W (MagSafe) và 15W (Qi2)\nSạc ngược 4.5W (không dây)"],
                    ['key' => 'Thiết kế', 'value' => "Khung nhôm vuông vức\nKính trước Ceramic Shield (2024)\nKính sau Corning-made\nKháng nước, bụi IP68"],
                    ['key' => 'Kết nối', 'value' => "USB Type-C 2.0, DisplayPort, NFC"]
                ];
                break;
                
            case 'iPhone 16 Plus':
                $specifications = [
                    ['key' => 'Hệ điều hành', 'value' => 'iOS 18'],
                    ['key' => 'Màn hình', 'value' => "Super Retina XDR OLED, HDR10, Dolby Vision\n1000 nits (typ), 2000 nits (HBM)\n6.7 inches, 1290 x 2796 pixels\nTỷ lệ 19.5:9, Mật độ điểm ảnh ~458 ppi\nKính bảo vệ Ceramic Shield (2004)"],
                    ['key' => 'Thẻ sim', 'value' => 'Nano SIM và eSIM'],
                    ['key' => 'Chip xử lý (CPU)', 'value' => 'Apple A18 6 nhân'],
                    ['key' => 'Chip đồ họa (GPU)', 'value' => 'Apple GPU 5 nhân'],
                    ['key' => 'Bộ nhớ trong', 'value' => "128GB\n256GB\n512GB"],
                    ['key' => 'Camera sau', 'value' => "48 MP, f/1.6, 26mm (góc rộng), dual pixel PDAF, sensor-shift OIS\n12 MP, f/2.2, 13mm, 120˚ (góc siêu rộng), dual pixel PDAF\n\nQuay phim: 4K@24/25/30/60fps, 1080p@25/30/60/120/240fps, HDR, Dolby Vision HDR (up to 60fps), stereo sound rec."],
                    ['key' => 'Camera trước', 'value' => "12 MP, f/1.9, 23mm (góc rộng), PDAF\nSL 3D (độ sâu/cảm biến sinh trắc)\n\nQuay phim: 4K@24/25/30/60fps, 1080p@25/30/60/120fps, gyro-EIS"],
                    ['key' => 'Dung lượng pin', 'value' => "Li-Ion 4325 mAh\nSạc nhanh >20W\nSạc không dây 25W (MagSafe) và 15W (Qi2)\nSạc ngược 4.5W (không dây)"],
                    ['key' => 'Thiết kế', 'value' => "Khung nhôm vuông vức\nKính trước Ceramic Shield (2024)\nKính sau Corning-made\nKháng nước, bụi IP68"],
                    ['key' => 'Kết nối', 'value' => "USB Type-C 2.0, DisplayPort, NFC"]
                ];
                break;
                
            case 'iPhone 16 Pro':
                $specifications = [
                    ['key' => 'Hệ điều hành', 'value' => 'iOS 18'],
                    ['key' => 'Màn hình', 'value' => "Super Retina XDR OLED, 120Hz, ProMotion\nHDR10, Dolby Vision\n1000 nits (HBM), 2000 nits (peak)\n6.3 inches, 1193 x 2610 pixels\nTỷ lệ 19.5:9, Mật độ điểm ảnh ~465 ppi\nKính bảo vệ Ceramic Shield (2024)\nCông nghệ Always-On display"],
                    ['key' => 'Thẻ sim', 'value' => 'Nano SIM và eSIM'],
                    ['key' => 'Chip xử lý (CPU)', 'value' => 'Apple A18 Pro 6 nhân'],
                    ['key' => 'Chip đồ họa (GPU)', 'value' => 'Apple GPU 6 nhân'],
                    ['key' => 'Bộ nhớ trong', 'value' => "128GB\n256GB\n512GB\n1TB"],
                    ['key' => 'Camera sau', 'value' => "48 MP, f/1.78, 24mm (góc rộng), dual pixel PDAF, sensor-shift OIS\n48 MP, f/2.8, 120mm (telephoto), PDAF, OIS, 5x optical zoom\n12 MP, f/2.2, 13mm, 120˚ (góc siêu rộng), dual pixel PDAF\nCảm biến ToF 3D LiDAR\n\nQuay phim: 4K@24/25/30/60fps, 1080p@25/30/60/120/240fps, 8K@30fps, HDR, Dolby Vision HDR (up to 60fps), ProRes, Cinematic mode (4K@30fps), stereo sound rec."],
                    ['key' => 'Camera trước', 'value' => "12 MP, f/1.9, 23mm (góc rộng), PDAF\nSL 3D (độ sâu/cảm biến sinh trắc)\n\nQuay phim: 4K@24/25/30/60fps, 1080p@25/30/60/120fps, gyro-EIS"],
                    ['key' => 'Dung lượng pin', 'value' => "Li-Ion 3650 mAh\nSạc nhanh 30W\nSạc không dây 25W (MagSafe) và 15W (Qi2)\nSạc ngược 4.5W (không dây)"],
                    ['key' => 'Thiết kế', 'value' => "Khung titan vuông vức\nMặt trước Ceramic Shield (2024)\nMặt sau kính mờ\nKháng nước, bụi IP68 (sâu tới 6m trong 30 phút)"],
                    ['key' => 'Kết nối', 'value' => "USB Type-C 2.0, DisplayPort, NFC"]
                ];
                break;
                
            case 'iPhone 16 Pro Max':
                $specifications = [
                    ['key' => 'Hệ điều hành', 'value' => 'iOS 18'],
                    ['key' => 'Màn hình', 'value' => "Super Retina XDR OLED, 120Hz, ProMotion\nHDR10, Dolby Vision\n1000 nits (HBM), 2000 nits (peak)\n6.9 inches, 1290 x 2796 pixels\nTỷ lệ 19.5:9, Mật độ điểm ảnh ~460 ppi\nKính bảo vệ Ceramic Shield (2024)\nCông nghệ Always-On display"],
                    ['key' => 'Thẻ sim', 'value' => 'Nano SIM và eSIM'],
                    ['key' => 'Chip xử lý (CPU)', 'value' => 'Apple A18 Pro 6 nhân'],
                    ['key' => 'Chip đồ họa (GPU)', 'value' => 'Apple GPU 6 nhân'],
                    ['key' => 'Bộ nhớ trong', 'value' => "256GB\n512GB\n1TB"],
                    ['key' => 'Camera sau', 'value' => "48 MP, f/1.78, 24mm (góc rộng), dual pixel PDAF, sensor-shift OIS\n48 MP, f/2.8, 120mm (telephoto), PDAF, OIS, 5x optical zoom\n48 MP, f/2.2, 13mm, 120˚ (góc siêu rộng), dual pixel PDAF\nCảm biến ToF 3D LiDAR\n\nQuay phim: 4K@24/25/30/60fps, 1080p@25/30/60/120/240fps, 8K@30fps, HDR, Dolby Vision HDR (up to 60fps), ProRes, Cinematic mode (4K@30fps), stereo sound rec."],
                    ['key' => 'Camera trước', 'value' => "12 MP, f/1.9, 23mm (góc rộng), PDAF\nSL 3D (độ sâu/cảm biến sinh trắc)\n\nQuay phim: 4K@24/25/30/60fps, 1080p@25/30/60/120fps, gyro-EIS"],
                    ['key' => 'Dung lượng pin', 'value' => "Li-Ion 4550 mAh\nSạc nhanh 30W\nSạc không dây 25W (MagSafe) và 15W (Qi2)\nSạc ngược 4.5W (không dây)"],
                    ['key' => 'Thiết kế', 'value' => "Khung titan vuông vức\nMặt trước Ceramic Shield (2024)\nMặt sau kính mờ\nKháng nước, bụi IP68 (sâu tới 6m trong 30 phút)"],
                    ['key' => 'Kết nối', 'value' => "USB Type-C 2.0, DisplayPort, NFC"]
                ];
                break;
        }
        
        foreach ($specifications as $spec) {
            ProductSpecification::create([
                'product_id' => $product->id,
                'key' => $spec['key'],
                'value' => $spec['value']
            ]);
        }
    }
}