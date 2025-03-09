<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Busca de Produtos</title>
        @livewireStyles
        <script src="https://cdn.tailwindcss.com"></script>

        <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                function initializeTomSelect() {
                    let selectedCategories = document.querySelector("[data-selected-categories]")?.dataset.selectedCategories || "";
                    let selectedBrands = document.querySelector("[data-selected-brands]")?.dataset.selectedBrands || "";

                    selectedCategories = selectedCategories ? selectedCategories.split(",") : [];
                    selectedBrands = selectedBrands ? selectedBrands.split(",") : [];

                    let categoriesSelect = new TomSelect("#categories-select", {
                        plugins: ['remove_button'],
                        persist: false,
                        create: false,
                        placeholder: "Selecione as categorias",
                        onChange: function () {
                            this.settings.placeholder = this.items.length ? "" : "Selecione as categorias";
                            this.refreshOptions();
                        },
                        onInitialize: function () {
                            let instance = this;
                            setTimeout(() => {
                                instance.close(); 
                            }, 100);
                        }
                    });

                    let brandsSelect = new TomSelect("#brands-select", {
                        plugins: ['remove_button'],
                        persist: false,
                        create: false,
                        placeholder: "Selecione as marcas",
                        onChange: function () {
                            this.settings.placeholder = this.items.length ? "" : "Selecione as marcas";
                            this.refreshOptions();
                        },
                        onInitialize: function () {
                            let instance = this;
                            setTimeout(() => {
                                instance.close();
                            }, 100);
                        }
                    });

                    categoriesSelect.setValue(selectedCategories);
                    brandsSelect.setValue(selectedBrands);

                    return { categoriesSelect, brandsSelect };
                }

                let tomSelectInstances = initializeTomSelect();

                document.addEventListener('livewire:load', function () {
                    tomSelectInstances = initializeTomSelect();
                });

                Livewire.hook('message.processed', (message, component) => {
                    tomSelectInstances.categoriesSelect.destroy();
                    tomSelectInstances.brandsSelect.destroy();
                    tomSelectInstances = initializeTomSelect();
                });

                let searchInput = document.getElementById("search-input");

                if (searchInput) {
                    searchInput.addEventListener("keydown", function (event) {
                        if (event.key === "Enter") {
                            event.preventDefault(); // Evita que o formulário seja enviado automaticamente
                            Livewire.dispatch("applyFilters"); // Livewire V3 usa dispatch()
                        }
                    });
                }             

                document.addEventListener("applyFilters", () => {
                    Livewire.dispatch("applyFilters");
                });
            });            
        </script>

    </head>
    <body>
        <div class="container mx-auto p-4">
            @yield('content')
        </div>
        @livewireScripts
    </body>
</html>