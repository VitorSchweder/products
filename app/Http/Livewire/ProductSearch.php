<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ProductSearch extends Component {
    public $search = '';
    public $categories = [];
    public $brands = [];
    public $selectedCategories = [];
    public $selectedBrands = [];

    public function render() {
        $products = Product::where('name', 'like', "%{$this->search}%")
            ->when($this->selectedCategories, function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            })
            ->when($this->selectedBrands, function ($query) {
                $query->whereIn('brand_id', $this->selectedBrands);
            })
            ->get();

        return view('livewire.product-search', compact('products'));
    }

    public function clearFilters() {
        $this->reset(['search', 'selectedCategories', 'selectedBrands']);
    }
}