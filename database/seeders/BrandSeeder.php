<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder {
    public function run() {
        Brand::insert([
            ['name' => 'Marca 1'],
            ['name' => 'Marca 2'],
            ['name' => 'Marca 3'],
        ]);
    }
}