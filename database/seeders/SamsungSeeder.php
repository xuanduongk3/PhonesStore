<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductSpecification;
use App\Models\Color;
use App\Models\Storage;
class SamsungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandId = 2; // Samsung
        $categoryId = 1; // Điện thoại
        $products = [
            ['name' => 'Samsung Galaxy A56', 'slug' => 'samsung_galaxy_a56', 'thumbnail' => 'samsung_galaxy_a56.png', 'colors' => ['black', 'green', 'gray']], // Chỉ lấy 3 màu này
        ];

        $this->createProducts($products, $brandId, $categoryId);
    }

    private function createProducts(array $products, int $brandId, int $categoryId)
    {
        $storages = Storage::where('id', 1)->get(); // Dung lượng ID = 1
        $priceBase = 9999000;

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

            // Lọc và tạo sản phẩm chỉ với 3 màu (black, green, gray)
            foreach ($prod['colors'] as $colorName) {
                $color = Color::where('name', $colorName)->first();

                // Kiểm tra nếu màu tồn tại trong cơ sở dữ liệu
                if ($color) {
                    foreach ($storages as $storage) {
                        ProductVariant::create([
                            'product_id' => $product->id,
                            'color_id' => $color->id,
                            'storage_id' => $storage->id,
                            'price' => $priceBase, // Giá cố định
                            'discount' => 10,
                            'stock' => rand(5, 20), // Số lượng ngẫu nhiên
                            'image' => "{$prod['slug']}_{$colorName}.png",
                        ]);
                    }
                }
            }
        }
    }

    private function addSpecifications($product)
    {
        $specifications = [];

        switch ($product->name) {
            case 'Samsung Galaxy A56':
                $specifications = [
                    ['key' => 'Hệ điều hành', 'value' => 'Android 15, One UI 7'],
                    ['key' => 'Màn hình', 'value' => "Super AMOLED, 120Hz, HDR10+, 1200 nits (HBM), 1900 nits (peak)\n6.7 inches, Full HD+ (1080 x 2340 pixels)\nTỷ lệ 19.5:9, mật độ điểm ảnh ~385 ppi"],
                    ['key' => 'Thẻ sim', 'value' => '2 SIM Nano và 2 eSIM'],
                    ['key' => 'CPU', 'value' => "Exynos 1580 (4 nm)\n8 nhân (1x2.9 GHz & 3x2.6 GHz & 4x1.9 GHz)\nGPU: Xclipse 540"],
                    ['key' => 'Bộ nhớ trong', 'value' => "128-256GB, UFS 3.1"],
                    ['key' => 'Camera sau', 'value' => "50 MP, f/1.8 (góc rộng), 1/1.56, 1.0µm, PDAF, OIS\n12 MP, f/2.2, 123˚ (góc siêu rộng), 1/3.06, 1.12µm\n5 MP, f/2.4 (macro)\nQuay phim: 4K@30fps, 1080p@30/60fps, gyro-EIS"],
                    ['key' => 'Camera trước', 'value' => "12 MP, f/2.2 (góc rộng)\nQuay phim: 4K@30fps, 1080p@30/60fps, 10-bit HDR"],
                    ['key' => 'Dung lượng pin', 'value' => "5000 mAh\nSạc nhanh 45W\nSạc 65% pin trong 30 ph, 100% trong 68 ph"],
                    ['key' => 'Thiết kế', 'value' => "Khung nhôm phẳng\nMặt lưng kính Gorilla Victus+ phẳng\nMàn hình phẳng kính Gorilla Victus+\nKháng nước, bụi IP67"],
                    ['key' => 'Kết nối', 'value' => "USB Type-C 2.0, OTG, NFC"]
                ];
                break;
        }   
        
        foreach ($specifications as $spec) {
            ProductSpecification::create([
                'product_id' => $product->id,
                'key' => $spec['key'],
                'value' => $spec['value'],
            ]);
        }
    }     
}
