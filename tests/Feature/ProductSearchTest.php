<?php

namespace Tests\Feature;

use App\Http\Livewire\ProductSearch;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductSearchTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_renders_the_product_search_component()
    {
        Livewire::test(ProductSearch::class)
            ->assertStatus(200)
            ->assertSee('Buscar Produto')
            ->assertSee('Categorias')
            ->assertSee('Marcas');
    }

    /** @test */
    public function it_filters_products_by_name()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $product1 = Product::factory()->create(['name' => 'iPhone 13', 'category_id' => $category->id, 'brand_id' => $brand->id]);
        $product2 = Product::factory()->create(['name' => 'Samsung Galaxy', 'category_id' => $category->id, 'brand_id' => $brand->id]);

        Livewire::test(ProductSearch::class)
            ->set('search', 'iPhone')
            ->call('applyFilters')
            ->assertSee('iPhone 13');
    }

    /** @test */
    public function it_filters_products_by_category()
    {
        $category1 = Category::factory()->create(['name' => 'Celulares']);
        $category2 = Category::factory()->create(['name' => 'Notebooks']);

        $product1 = Product::factory()->create(['name' => 'iPhone 13', 'category_id' => $category1->id]);
        $product2 = Product::factory()->create(['name' => 'MacBook Pro', 'category_id' => $category2->id]);

        Livewire::test(ProductSearch::class)
            ->set('selectedCategories', [$category1->id])
            ->call('applyFilters')
            ->assertSee('iPhone 13');
    }

    /** @test */
    public function it_filters_products_by_brand()
    {
        $brand1 = Brand::factory()->create(['name' => 'Apple']);
        $brand2 = Brand::factory()->create(['name' => 'Samsung']);

        $product1 = Product::factory()->create(['name' => 'iPhone 13', 'brand_id' => $brand1->id]);
        $product2 = Product::factory()->create(['name' => 'Galaxy S22', 'brand_id' => $brand2->id]);

        Livewire::test(ProductSearch::class)
            ->set('selectedBrands', [$brand1->id])
            ->call('applyFilters')
            ->assertSee('iPhone 13');
    }

    /** @test */
    public function it_clears_filters_correctly()
    {
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();

        $product1 = Product::factory()->create(['name' => 'iPhone 13', 'category_id' => $category->id, 'brand_id' => $brand->id]);
        $product2 = Product::factory()->create(['name' => 'Samsung Galaxy', 'category_id' => $category->id, 'brand_id' => $brand->id]);

        Livewire::test(ProductSearch::class)
            ->set('search', 'iPhone')
            ->set('selectedCategories', [$category->id])
            ->set('selectedBrands', [$brand->id])
            ->call('clearFilters')
            ->assertSet('search', '')
            ->assertSet('selectedCategories', [])
            ->assertSet('selectedBrands', []);
    }

    /** @test */
    public function it_filters_products_when_pressing_enter()
    {
        $product1 = Product::factory()->create(['name' => 'iPhone 13']);
        $product2 = Product::factory()->create(['name' => 'Galaxy S22']);

        Livewire::test(ProductSearch::class)
            ->set('search', 'iPhone')
            ->dispatch('applyFilters')
            ->assertSee('iPhone 13');
    }
}
