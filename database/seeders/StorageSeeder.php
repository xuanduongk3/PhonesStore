<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Storage;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $storages = [
            '8-128', '8-256', '8-512',
            '12-256', '12-512'
        ];

        foreach ($storages as $cap) {
            Storage::create(['capacity' => $cap]);
        }
    }
}
