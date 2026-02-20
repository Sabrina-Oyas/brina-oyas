# 1. Image PHP avec Apache
FROM php:8.2-apache

# 2. Installation de Composer (l'outil qui crée le dossier vendor)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Configuration de base
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Dépendances système (nécessaires pour Composer et certaines extensions)
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo_mysql intl

RUN a2enmod rewrite

# 5. Copie des fichiers de configuration de Composer en premier (optimise le cache)
WORKDIR /var/www/html
COPY composer.json composer.lock* ./

# 6. Installation des dépendances PHP
# On utilise --no-dev pour la production (plus léger)
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# 7. Copie du reste du code source
COPY . .

# 8. Génération de l'autoload final
RUN composer dump-autoload --optimize --no-dev

# 9. Droits d'accès
RUN chown -R www-data:www-data /var/www/html

# 10. Port Render
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
EXPOSE ${PORT}

CMD ["apache2-foreground"]