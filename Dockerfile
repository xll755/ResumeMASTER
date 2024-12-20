FROM php:8.3.4RC1-apache-bookworm

# install mysqli for db php connections
RUN docker-php-ext-install mysqli

# install git & zip for composer install
RUN apt-get update && \
    apt-get install -y git zip && \
    rm -rf /tmp/* /var/tmp/*


WORKDIR /app
COPY composer.json composer.json

# install composer
RUN curl -sS https://getcomposer.org/installer -o composer-installer && \
    php composer-installer --filename composer && \
    rm composer-installer

RUN ./composer install --no-dev --prefer-dist

# add python & required dependencies
# RUN apt-get install -y python3 pip && \
RUN apt-get install -y python3 python3-pip python3-venv && \
    rm -rf /tmp/* /var/tmp/*

# RUN pip install python-dotenv
RUN python3 -m venv /app/.venv
RUN /app/.venv/bin/pip install google-generativeai python-dotenv

WORKDIR /var/www/html

#RUN docker-php-ext-enable mysqli
