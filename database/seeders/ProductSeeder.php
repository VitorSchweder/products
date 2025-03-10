<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductSeeder extends Seeder {
    public function run() {
        $categories = Category::all();
        $brands = Brand::all();

        Product::insert([
            ['name' => 'Produto 1', 'category_id' => $categories->firstWhere('name', 'Categoria 1')->id, 'brand_id' => $brands->firstWhere('name', 'Marca 1')->id],
            ['name' => 'Produto 2', 'category_id' => $categories->firstWhere('name', 'Categoria 2')->id, 'brand_id' => $brands->firstWhere('name', 'Marca 2')->id],
            ['name' => 'Produto 3', 'category_id' => $categories->firstWhere('name', 'Categoria 3')->id, 'brand_id' => $brands->firstWhere('name', 'Marca 3')->id],
            ['name' => 'Produto 4', 'category_id' => $categories->firstWhere('name', 'Categoria 1')->id, 'brand_id' => $brands->firstWhere('name', 'Marca 1')->id],
            ['name' => 'Produto 5', 'category_id' => $categories->firstWhere('name', 'Categoria 2')->id, 'brand_id' => $brands->firstWhere('name', 'Marca 2')->id],
            ['name' => 'Produto 6', 'category_id' => $categories->firstWhere('name', 'Categoria 3')->id, 'brand_id' => $brands->firstWhere('name', 'Marca 3')->id],
        ]);
    }
}