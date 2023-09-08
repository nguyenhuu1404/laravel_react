FROM php:8.2-fpm

ENV TZ Asia/Tokyo

RUN apt-get update && \
	apt-get install -y git unzip libzip-dev libicu-dev libonig-dev libpq-dev && \
	docker-php-ext-install intl pdo pdo_mysql zip bcmath

RUN pecl install xdebug \
 && docker-php-ext-enable xdebug
		
COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
