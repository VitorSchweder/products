## Passo a passo de como executar o projeto

### Instalação
1. Após clonar o repositório
2. Entre no diretório do projeto:
   ```bash
   cd products
   ```
3. Suba os containers Docker:
   ```bash
    docker-compose up -d --build
   ```
4. Instalar as dependências e publicar livewire:
   ```bash
    docker-compose exec app composer require livewire/livewire
    docker-compose exec app php artisan livewire:publish
    docker compose exec app composer install
   ```
5. Configure o ambiente:
   ```bash
    cp .env.example .env
    docker-compose exec app php artisan key:generate
   ```
6. Rode as migrations e seeders:
   ```bash
    docker-compose exec app php artisan migrate --seed
   ```
7. Acesse no navegador: [http://localhost:8080](http://localhost:8080)