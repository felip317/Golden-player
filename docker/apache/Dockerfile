FROM php:8.2-apache

# Habilitar mysqli
RUN docker-php-ext-install mysqli

# DocumentRoot correcto
ENV APACHE_DOCUMENT_ROOT /var/www/html/app/GoldenPlayer

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# Copiar todo el proyecto
COPY . /var/www/html

# Permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
