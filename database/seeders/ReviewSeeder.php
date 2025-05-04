<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Review;
class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::where('role', 'customer')->get();
        $products = Product::all();

        foreach ($products as $product) {
            // Mỗi sản phẩm có 2-4 đánh giá
            $reviewers = $users->random(rand(2, 4));

            foreach ($reviewers as $user) {
                Review::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'rating' => rand(4, 5),
                    'comment' => fake()->sentence(rand(8, 16)),
                ]);
            }
        }
    }
}