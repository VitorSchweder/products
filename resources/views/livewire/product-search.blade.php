<div>
    <input type="text" wire:model.debounce.500ms="search" placeholder="Buscar produto...">

    <h4>Categorias</h4>
    @foreach ($categories as $category)
        <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}"> {{ $category->name }}
    @endforeach

    <h4>Marcas</h4>
    @foreach ($brands as $brand)
        <input type="checkbox" wire:model="selectedBrands" value="{{ $brand->id }}"> {{ $brand->name }}
    @endforeach

    <button wire:click="clearFilters">Limpar filtros</button>

    <ul>
        @foreach ($products as $product)
            <li>{{ $product->name }} ({{ $product->category->name }} - {{ $product->brand->name }})</li>
        @endforeach
    </ul>
</div>
