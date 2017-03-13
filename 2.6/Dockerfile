FROM php:7-apache

ENV CRAFT_VERSION 2.6
ENV CRAFT_BUILD 2966
ENV CRAFT_ZIP Craft-$CRAFT_VERSION.$CRAFT_BUILD.zip

RUN apt-get update \
	&& apt-get install -yq unzip libmcrypt-dev libmagickwand-dev \
	&& docker-php-ext-install pdo_mysql mcrypt \
	&& pecl install imagick \
	&& docker-php-ext-enable imagick \
	&& rm -rf /var/lib/apt/lists/*

# Enable .htaccess
RUN a2enmod rewrite

ADD https://download.buildwithcraft.com/craft/$CRAFT_VERSION/$CRAFT_VERSION.$CRAFT_BUILD/$CRAFT_ZIP /tmp/$CRAFT_ZIP

RUN unzip -q /tmp/$CRAFT_ZIP -d /var/www/ \
	&& rm /tmp/$CRAFT_ZIP \
	&& mv /var/www/public/* /var/www/html/ \
	&& mv /var/www/html/htaccess /var/www/html/.htaccess \
	&& rmdir /var/www/public

# Allow database connection to be configured with environment variables
ADD db.php /var/www/craft/config/

RUN chown -R www-data:www-data \
	/var/www/craft/app/ \
	/var/www/craft/config/ \
	/var/www/craft/storage/
