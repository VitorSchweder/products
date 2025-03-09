<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder {
    public function run() {
        Category::insert([
            ['name' => 'Categoria 1'],
            ['name' => 'Categoria 2'],
            ['name' => 'Categoria 3'],
        ]);
    }
}