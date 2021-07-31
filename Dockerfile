FROM php:7.3-apache

ENV HOME /var/www/html/

COPY --chown=www-data:www-data . $HOME
COPY apache2-laravel.conf /etc/apache2/sites-available/laravel.conf

WORKDIR $HOME

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --version=1.8.6 --install-dir=/usr/local/bin --filename=composer

RUN apt-get update -yqq && \
  apt-get install -y zip unzip && \
  apt-get install -y nano && \
  apt-get install -y curl && \
  apt-get install -y sudo && \
  apt-get install -y libmcrypt-dev && \
  apt-get install -y --no-install-recommends apt-utils && \
  apt-get install -y libxml2-dev && \
  apt-get install -y libzip-dev && \
  a2enmod rewrite && \
  docker-php-ext-install mysqli pdo pdo_mysql && \
  docker-php-ext-install mbstring && \
  docker-php-ext-install soap && \
  docker-php-ext-configure zip --with-libzip && \
  docker-php-ext-install zip && \
  rm -rf /var/lib/apt/lists/*

RUN composer install --ignore-platform-reqs
RUN chown www-data:www-data -R /var/www/html
RUN chmod -R ug+rwx /var/www/html/storage

CMD ["apache2-foreground"]
EXPOSE 80
