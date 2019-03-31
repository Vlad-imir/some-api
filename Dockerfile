FROM php:7.2-cli
RUN docker-php-ext-install mbstring pdo_mysql
CMD php init/init.php && php -S 0.0.0.0:8000 ./web/index.php
