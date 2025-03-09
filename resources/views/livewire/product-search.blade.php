<div class="p-6 max-w-full mx-auto"
     data-selected-categories="{{ implode(',', $selectedCategories) }}"
     data-selected-brands="{{ implode(',', $selectedBrands) }}">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div>
            <label class="font-semibold">Buscar Produto</label>
            <input type="text" wire:model="search" 
                   id="search-input"
                   placeholder="Digite o nome do produto..." 
                   class="w-full border rounded-md p-2 mt-1 text-gray-700">
        </div>

        <div>
            <label class="font-semibold">Categorias</label>
            <select wire:model="selectedCategories" id="categories-select" multiple class="select w-full border rounded-md p-2 mt-1">
                <option value="" disabled>Selecione as categorias</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="font-semibold">Marcas</label>
            <select wire:model="selectedBrands" id="brands-select" multiple class="select w-full border rounded-md p-2 mt-1">
                <option value="" disabled>Selecione as marcas</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="flex gap-4 mb-6">
        <button wire:click="applyFilters"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Filtrar
        </button>

        <button wire:click="clearFilters"
                class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">
            Limpar filtros
        </button>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-3 text-left">Nome</th>
                    <th class="border p-3 text-left">Categoria</th>
                    <th class="border p-3 text-left">Marca</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-100">
                        <td class="border p-3">{{ $product->name }}</td>
                        <td class="border p-3">{{ optional($product->category)->name }}</td>
                        <td class="border p-3">{{ optional($product->brand)->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border p-3 text-center text-gray-500">Nenhum produto encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
