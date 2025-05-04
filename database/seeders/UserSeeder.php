<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '0123456789',
            'role' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // Mật khẩu mã hóa
        ]);

        // Tạo một số khách hàng
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Customer $i",
                'email' => "customer{$i}@example.com",
                'phone' => '09000000' . $i,
                'role' => 'customer',
                'email_verified_at' => now(),
                'password' => Hash::make('12345678'),
            ]);
        }
    }
}
