<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laptop;

class LaptopSeeder extends Seeder
{
    public function run(): void
    {
        Laptop::create([
            'merk' => 'Dell',
            'model' => 'XPS 15',
            'spesifikasi' => 'Intel i7, 16GB RAM, 512GB SSD',
            'harga_harian' => 150000,
            'status' => 'tersedia'
        ]);

        Laptop::create([
            'merk' => 'HP',
            'model' => 'Pavilion 14',
            'spesifikasi' => 'Intel i5, 8GB RAM, 256GB SSD',
            'harga_harian' => 100000,
            'status' => 'tersedia'
        ]);
    }
}