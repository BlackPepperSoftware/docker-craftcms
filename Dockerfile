FROM php:7.3-apache

LABEL maintainer = "Mark Hobson <mark.hobson@blackpepper.co.uk>"

# Set craft installer and CMS versions
ARG CMS_VERSION=3.6.10
ARG CRAFT_VERSION=1.1.2

WORKDIR /var/www

RUN apt-get update \
	&& apt-get install -yq unzip libmcrypt-dev libmagickwand-dev libzip-dev wget mariadb-client-10.3 \
	&& docker-php-ext-install zip pdo_mysql \
	&& pecl install imagick mcrypt-1.0.2 \
	&& docker-php-ext-enable imagick mcrypt \
	&& rm -rf /var/lib/apt/lists/*

# Enable .htaccess
RUN a2enmod rewrite

# Download and configure Craft
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
	&& rm -r /var/www/* \
	&& composer create-project craftcms/craft /var/www $CRAFT_VERSION \
	&& composer require -W -d /var/www craftcms/cms:$CMS_VERSION \
	&& chmod +x /var/www/craft \
	&& sed -i "s/html/web/" /etc/apache2/sites-available/000-default.conf \
	&& chown -R www-data:www-data /var/www/* /var/www/.[^.]* \
	&& echo "php_value memory_limit 256M" >> /var/www/web/.htaccess \
	&& service apache2 restart

# Move our general config file into config directory
ADD --chown=www-data:www-data general.php /var/www/config/

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

# Set up security key
RUN /var/www/craft setup/security-key

USER root
