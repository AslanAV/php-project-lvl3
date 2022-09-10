FROM php:8.1.10-cli

ARG WWWGROUP
ARG WWWUSER
ARG GUID
ARG UID

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev
RUN docker-php-ext-install pdo pdo_pgsql zip
# RUN docker-php-ext-configure pdo pdo_pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

RUN pecl install xdebug-3.1.5 \
    && docker-php-ext-enable \
        xdebug \
    && rm -rf /tmp/pear

RUN apt-get update && apt-get install -y unzip

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

WORKDIR /app

COPY . .
RUN npm install -g npm@8.18.0
RUN composer update
RUN npm update
RUN npm i vite && npm i laravel-vite-plugin
RUN make install
RUN make build-front

RUN > database/database.sqlite

CMD ["bash", "-c", "php artisan migrate:refresh --seed --force && php artisan serve --host=0.0.0.0 --port=$PORT"]
