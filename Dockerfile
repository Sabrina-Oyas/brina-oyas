# 1. Image PHP avec Apache
FROM php:8.2-apache

# 2. Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Configuration de base Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Dépendances système
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo_mysql intl

RUN a2enmod rewrite

# 5. Dossier de travail
WORKDIR /var/www/html

# 6. Installation des dépendances PHP (Optimisation cache)
COPY composer.json composer.lock* ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# 7. Copie du code source
COPY . .

# 8. Génération de l'autoload
RUN composer dump-autoload --optimize --no-dev

# 9. Droits d'accès (LA CORRECTION EST ICI)
# On crée les dossiers s'ils n'existent pas et on donne les droits à www-data
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# 10. Port Render
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
EXPOSE ${PORT}

CMD ["apache2-foreground"]