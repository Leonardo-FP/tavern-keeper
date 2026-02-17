#!/bin/sh

echo "Aguardando MySQL..."

while ! php -r "
try {
    new PDO('mysql:host=db;dbname=tavern_keeper', 'tavern_keeper_user', '12345678');
} catch (Exception \$e) {
    exit(1);
}
"; do
    sleep 2
done

echo "Rodando migrations..."
php artisan migrate --force

echo "Rodando seeders..."
php artisan db:seed --force

echo "Iniciando PHP-FPM..."
exec php-fpm