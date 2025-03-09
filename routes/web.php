<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\ProductSearch;
use Livewire\Livewire;

Route::get('/', function () {
    return view('welcome');
})->name('product.search');


Livewire::component('product-search', ProductSearch::class);
