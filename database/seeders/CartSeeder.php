<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cart;
use App\Models\User;
use App\Models\ProductVariant;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'customer')->get();
        $productVariants = ProductVariant::all();

        foreach ($users as $user) {
            // Lấy ngẫu nhiên từ 2 đến 4 biến thể
            $randomVariants = $productVariants->random(rand(1, 3));

            foreach ($randomVariants as $variant) {
                Cart::create([
                    'user_id' => $user->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => rand(1, 3),
                ]);
            }
        }
    }
}
