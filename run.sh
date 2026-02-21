#!/bin/bash

# 1. On prépare la config
php artisan config:clear

# 2. On lance les migrations (sans le && qui fait planter)
php artisan migrate --force

# 3. On démarre le serveur web (Spécifique à l'image richarvey)
/usr/bin/supervisord -n -c /etc/supervisor/conf.d/supervisord.conf