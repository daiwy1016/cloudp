FROM php:7.0-apache-stretch

RUN apt-get update
RUN apt-get install -y iputils-ping
RUN apt-get install -y gcc
RUN apt-get install -y autoconf
RUN apt-get install -y libc-dev
RUN apt-get install -y pkg-config
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libpq-dev
RUN apt-get install -y libxslt-dev

RUN docker-php-ext-install iconv
RUN docker-php-ext-install mcrypt
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pgsql
RUN docker-php-ext-install xsl
RUN docker-php-ext-install opcache

RUN pecl install xdebug-2.6.0
RUN docker-php-ext-enable xdebug

RUN mkdir /web
RUN mkdir /web/log
RUN mkdir /web/root

COPY src /web/root
COPY apache.conf /etc/apache2/sites-available/000-default.conf

RUN chmod -R 755 /web
RUN a2enmod rewrite