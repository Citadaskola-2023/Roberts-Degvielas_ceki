# ./Dockerfile
FROM dunglas/frankenphp:alpine

RUN install-php-extensions \
    pdo_mysql \
    xdebug

COPY ./etc/php/99-xdebug.ini "${PHP_INI_DIR}/conf.d"
