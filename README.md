renomear o .env.exemple para .env e alterar as configuracoes de banco de dados

rodar o 
```
composer install 
```
e o 
```
npm install
```
Criar Banco de dados com 
```
php artisan db:create
```
Rodar as Migrations 
```
php artisan migrate 
```
insita o token da api do TMDB no .env na variavel TMDB_TOKEM

esta indo uma copia do banco caso de algo errado com o consumo da api na pasta database
```
npm run dev 
```
para rodar no endereco http://teste-filmes.test

caso queira da para rodar com o laravel artisan serve
