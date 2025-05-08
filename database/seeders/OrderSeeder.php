<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\ProductVariant;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::where('role', 'customer')->get();
        $variants = ProductVariant::all();
        $statusRandom = ['Chờ xác nhận', 'Đang chuẩn bị hàng', 'Đang giao hàng', 'Đã giao hàng'];
        foreach ($users as $user) {
            if ($user->addresses->isEmpty()) continue;

            for ($i = 0; $i < rand(1, 2); $i++) {
                $address = $user->addresses->random();
                $shippingFee = 20000;
                $order = Order::create([
                    'user_id' => $user->id,
                    'address_id' => $address->id,
                    'shipping_fee' => $shippingFee,
                    'total_price' => 0, // sẽ cập nhật bên dưới
                    'status' => $statusRandom[array_rand($statusRandom)],
                    'note' => fake()->optional()->sentence(),
                ]);

                $total = 0;
                $selectedVariants = $variants->random(rand(1, 3));

                foreach ($selectedVariants as $variant) {
                    $quantity = rand(1, 3);
                    $unitPrice = $variant->price * (1 - $variant->discount / 100);

                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_variant_id' => $variant->id,
                        'quantity' => $quantity,
                        'unit_price' => $unitPrice,
                    ]);

                    $total += $quantity * $unitPrice;
                }

                // Cập nhật lại tổng giá đơn hàng
                $order->update([
                    'total_price' => $total + $shippingFee,
                ]);
            }
        }
    }
}
