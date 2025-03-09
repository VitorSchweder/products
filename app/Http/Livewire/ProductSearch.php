<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Request;

class ProductSearch extends Component {
    public $search = '';
    public $categories = [];
    public $brands = [];
    public $selectedCategories = [];
    public $selectedBrands = [];
    public $products = [];
    protected $listeners = ['applyFilters'];

    public function mount() {
        $this->categories = Category::all();
        $this->brands = Brand::all();
    
        $this->search = request()->query('search', '');
        $this->selectedCategories = request()->query('categories', '');
        $this->selectedBrands = request()->query('brands', '');
    
        $this->selectedCategories = $this->selectedCategories ? explode(',', $this->selectedCategories) : [];
        $this->selectedBrands = $this->selectedBrands ? explode(',', $this->selectedBrands) : [];
    
        $this->updateProducts();
    }
    
    public function applyFilters() {
        $queryParams = [
            'search' => $this->search,
            'categories' => implode(',', $this->selectedCategories),
            'brands' => implode(',', $this->selectedBrands),
        ];
    
        return redirect()->to(route('product.search', $queryParams));
    }

    private function updateProducts() {
        $this->products = Product::with(['category', 'brand'])
            ->when(!empty($this->search), function ($query) {
                $query->where('name', 'like', "%{$this->search}%");
            })
            ->when(!empty($this->selectedCategories), function ($query) {
                $query->whereIn('category_id', $this->selectedCategories);
            })
            ->when(!empty($this->selectedBrands), function ($query) {
                $query->whereIn('brand_id', $this->selectedBrands);
            })
            ->get();
    }

    public function clearFilters() {
        $this->reset(['search', 'selectedCategories', 'selectedBrands']);
        return redirect('/');
    }

    public function render() {
        return view('livewire.product-search')->layout('layouts.app');
    }
}
