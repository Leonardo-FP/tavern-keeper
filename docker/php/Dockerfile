FROM php:8.3-fpm

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    curl \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar apenas arquivos do Composer
COPY ./src/backend/composer.* /var/www/

# Instalar dependências
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copiar projeto
COPY ./src/backend /var/www

# Rodar scripts do Laravel
RUN php artisan package:discover --ansi

# 👇 copiar entrypoint
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 9000

# 👇 definir entrypoint
ENTRYPOINT ["entrypoint.sh"]