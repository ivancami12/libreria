FROM php:8.3-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y git curl zlib1g-dev libzip-dev unzip sqlite3 wget

# Descarga, instalación de composer, luego la eliminación del instalador
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

#I nstalación como un comadno global
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /root
#RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli

#RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
#RUN symfony serve
EXPOSE 8000
WORKDIR /var/www/html
