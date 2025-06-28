# Usa imagem oficial do PHP com Apache embutido
FROM php:8.2-apache

# Instala extensões do PHP necessárias ao Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    unzip \
 && docker-php-ext-install pdo_mysql mbstring zip gd \
 && a2enmod rewrite

# Altera o DocumentRoot do Apache para apontar pro /public do Laravel
RUN sed -i 's#/var/www/html#/var/www/public#g' /etc/apache2/sites-available/000-default.conf

# Define diretório de trabalho e copia o código do Laravel
WORKDIR /var/www
COPY ./src /var/www

# Ajusta permissões para evitar erros com cache, logs e sessions
RUN chown -R www-data:www-data /var/www \
 && chmod -R 755 /var/www

# Expõe a porta padrão HTTP
EXPOSE 80

# Inicia o Apache em primeiro plano
CMD ["apache2ctl", "-D", "FOREGROUND"]

