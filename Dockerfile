FROM php:7.1-apache

LABEL maintainer = "Mark Hobson <mark.hobson@blackpepper.co.uk>"

RUN apt-get update \
	&& apt-get install -yq unzip libmcrypt-dev libmagickwand-dev wget \
	&& docker-php-ext-install zip pdo_mysql mcrypt \
	&& pecl install imagick \
	&& docker-php-ext-enable imagick \
	&& rm -rf /var/lib/apt/lists/*

# Enable .htaccess
RUN a2enmod rewrite

# Retrieve and unzip craft
ARG CRAFT_VERSION=3.0
ARG CRAFT_BUILD=18
ENV CRAFT_ZIP=Craft-$CRAFT_VERSION.$CRAFT_BUILD.zip
RUN wget https://download.craftcdn.com/craft/$CRAFT_VERSION/$CRAFT_ZIP -O /tmp/$CRAFT_ZIP \
    && unzip -q /tmp/$CRAFT_ZIP -d /var/www/ \
	&& rm /tmp/$CRAFT_ZIP \
	&& sed -i "s/html/web/" /etc/apache2/sites-available/000-default.conf \
	&& rm -r /var/www/html

# Move our general config file into config directory
ADD general.php /var/www/config/

RUN chown -R www-data:www-data /var/www/ \
    && chmod -R 777 /var/www/

# Set up security key. This will be used by craft to encrypt data such as passwords in the database. This was optional
# in craft 2 but now mandatory in 3.
RUN cd /var/www/ \
    && ./craft setup/security-key

# Set environment variables
ENV DB_SERVER=localhost \
	DB_PORT=3306 \
	DB_USER=root \
	DB_PASSWORD="" \
	DB_TABLE_PREFIX=craft \
	DB_DATABASE="" \
	CRAFT_ALLOW_AUTO_UPDATES=true \
	CRAFT_COOLDOWN_DURATION=PT5M \
	CRAFT_DEV_MODE=true \
	CRAFT_MAX_UPLOAD_FILE_SIZE=16777216 \
	CRAFT_OMIT_SCRIPT_NAME_IN_URLS=auto \
	CRAFT_USE_COMPRESSED_JS=true \
	CRAFT_USER_SESSION_DURATION=PT1H

RUN chmod -R 777 /var/www/storage/