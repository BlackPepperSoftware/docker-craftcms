FROM php:7.1-apache

LABEL maintainer = "Mark Hobson <mark.hobson@blackpepper.co.uk>"

RUN apt-get update \
	&& apt-get install -yq unzip libmcrypt-dev libmagickwand-dev wget mariadb-client-10.1 \
	&& docker-php-ext-install zip pdo_mysql mcrypt \
	&& pecl install imagick \
	&& docker-php-ext-enable imagick \
	&& rm -rf /var/lib/apt/lists/*

# Enable .htaccess
RUN a2enmod rewrite

# Retrieve and unzip craft
ARG CRAFT_VERSION=3.1
ARG CRAFT_BUILD=29
ENV CRAFT_ZIP=Craft-$CRAFT_VERSION.$CRAFT_BUILD.zip
RUN wget https://download.craftcdn.com/craft/$CRAFT_VERSION/$CRAFT_ZIP -O /tmp/$CRAFT_ZIP \
    && unzip -q /tmp/$CRAFT_ZIP -d /var/www/ \
	&& rm /tmp/$CRAFT_ZIP \
	&& chmod +x /var/www/craft \
	&& sed -i "s/html/web/" /etc/apache2/sites-available/000-default.conf \
	&& rm -r /var/www/html \
	&& echo "php_value memory_limit 256M" >> /var/www/web/.htaccess \
	&& service apache2 restart

# Move our general config file into config directory
ADD general.php /var/www/config/

# Set ownership
RUN chown -R www-data:www-data \
	/var/www/.env \
	/var/www/composer.json \
	/var/www/composer.lock \
	/var/www/config \
	/var/www/storage \
	/var/www/vendor \
	/var/www/web/cpresources

# Set up security key
RUN truncate -s0 /var/www/.env
USER www-data
RUN /var/www/craft setup/security-key
USER root

# Set environment variables
ENV DB_DRIVER=mysql \
	DB_SERVER=localhost \
	DB_PORT=3306 \
	DB_USER=root \
	DB_PASSWORD="" \
	DB_TABLE_PREFIX=craft \
	DB_DATABASE=""
