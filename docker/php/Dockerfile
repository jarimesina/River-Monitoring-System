FROM php:7.3.6-fpm

# install composer
RUN cd /usr/bin && curl -s https://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer

# install utilities
RUN apt-get update \
&& apt-get install -y \
git \
zip \
unzip \
vim

# install php extention
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo_mysql pdo_pgsql

# install nodejs and npm
RUN apt-get update || apt-get update
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash -
RUN apt-get install -y nodejs \
&& apt-get install npm

WORKDIR /var/www/html
