FROM phpearth/php:7.4-nginx

RUN apk add --no-cache php7.4-dev gcc g++ php7.4-pdo_mysql php7.4-intl php7.4-iconv
RUN apk add --no-cache composer
RUN apk add --no-cache tzdata

ENV TZ Europe/Warsaw

RUN apk add mysql-client

RUN pecl install apcu

COPY docker/app.conf /etc/nginx/conf.d/default.conf
COPY docker/php.ini /etc/php/7.4/php.ini

WORKDIR /var/www/html/
COPY . /var/www/html

RUN mkdir /var/www/html/var; exit 0
RUN chmod 777 /var/www/html/var -R