FROM php:7.3-apache

LABEL maintainer = "Mark Hobson <mark.hobson@blackpepper.co.uk>"

WORKDIR /var/www

RUN apt-get update \
	&& apt-get install -yq unzip libmcrypt-dev libmagickwand-dev libzip-dev wget mariadb-client-10.3 \
	&& docker-php-ext-install zip pdo_mysql \
	&& pecl install imagick mcrypt-1.0.2 \
	&& docker-php-ext-enable imagick mcrypt \
	&& rm -rf /var/lib/apt/lists/*

# Enable .htaccess
RUN a2enmod rewrite

# Retrieve and unzip craft
ARG CRAFT_VERSION=3.3
ARG CRAFT_BUILD=11
ENV CRAFT_ZIP=Craft-$CRAFT_VERSION.$CRAFT_BUILD.zip
RUN wget https://download.craftcdn.com/craft/$CRAFT_VERSION/$CRAFT_ZIP -O /tmp/$CRAFT_ZIP \
    && unzip -q /tmp/$CRAFT_ZIP -d /var/www/ \
	&& rm /tmp/$CRAFT_ZIP \
	&& chmod +x /var/www/craft \
	&& sed -i "s/html/web/" /etc/apache2/sites-available/000-default.conf \
	&& rm -r /var/www/html \
	&& chown -R www-data:www-data /var/www/* /var/www/.[^.]* \
	&& echo "php_value memory_limit 256M" >> /var/www/web/.htaccess \
	&& service apache2 restart

# Move our general config file into config directory
ADD --chown=www-data:www-data general.php /var/www/config/

# Set up security key
USER www-data

# Set environment variables
RUN truncate -s0 /var/www/.env
ENV DB_DRIVER=mysql \
	DB_SERVER=localhost \
	DB_PORT=3306 \
	DB_USER=root \
	DB_PASSWORD="" \
	DB_TABLE_PREFIX=craft \
	DB_DATABASE=""

RUN /var/www/craft setup/security-key

USER root
