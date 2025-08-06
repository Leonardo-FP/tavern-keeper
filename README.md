# **Projeto Tavern Keeper - Laravel 12 + Vue 3 + Docker**

Tavern Keeper é uma aplicação web feita para ajudar mestres e jogadores de RPG de mesa a organizarem suas sessões de forma temática, imersiva e sem complicação.

🎲 Crie personagens, registre aventuras, gerencie campanhas e mantenha o espírito da taverna sempre vivo!

## **Requisitos**

- Docker e Docker Compose instalados em sua máquina.

## **Execute os passos abaixo para rodar o projeto**

```bash
# Clone o repositório público presente no endereço
https://github.com/Leonardo-FP/tavern-keeper.git

# CONFIGURAÇÃO DO AMBIENTE

## Após clonar, entre no projeto
cd tavern-keeper

## Copie o arquivo .env presente na raiz do projeto, que define as variáveis USER_ID e GROUP_ID. Essas variáveis configuram o usuário que o container PHP vai usar, garantindo que os arquivos criados (como via comandos artisan) tenham permissões compatíveis com seu usuário do WSL
cp .env.example .env

## Lembre de alterar os valores de USER_ID e GROUP_ID no .env para que correspondam aos do seu usuário no sistema. Você pode verificar isso rodando o comando no WSL:
id -u && id -g

## Verifique no .env as configurações do banco de dados e altere (caso necessário) conforme a configuração do seu Docker 
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=tavern_keeper
DB_USERNAME=tavern_keeper_user
DB_PASSWORD=12345678

## Construa e rode os containers
docker-compose up --build -d

## Acesse o container do PHP
docker exec -it laravel-php bash

## Instale as dependências do projeto
composer install

## Ajuste permissões de diretórios
chmod -R 775 storage && chown -R www-data:www-data storage && chmod -R 775 storage/framework

## Gere a Key do Laravel
php artisan key:generate

## Rode as migrations
php artisan migrate