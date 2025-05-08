<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = User::where('role', 'customer')->get();

        foreach ($users as $user) {
            $addressCount = rand(1, 2);

            for ($i = 1; $i <= $addressCount; $i++) {
                Address::create([
                    'user_id' => $user->id,
                    'phone' => fake()->phoneNumber(),
                    'address_line' => fake()->address(),
                    'city' => fake()->city(),
                    'district' => fake()->city(),
                    'ward' => fake()->city(),
                    'is_default' => $i === 0,
                ]);
            }
        }
    }
}
