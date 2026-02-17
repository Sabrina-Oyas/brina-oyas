FROM richarvey/nginx-php-fpm:latest
COPY . .
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
RUN composer install --no-dev