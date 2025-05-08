<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Banner;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            BannerSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            StorageSeeder::class,
            AppleSeeder::class,
            SamsungSeeder::class,
            UserSeeder::class,
            ReviewSeeder::class,
            CartSeeder::class,
            AddressSeeder::class,
            OrderSeeder::class
        ]);
    }
}
