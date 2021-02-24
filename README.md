# docker-craftcms

Docker image for [Craft CMS](https://craftcms.com/). Available on Docker Hub as [blackpepper/craftcms](https://hub.docker.com/r/blackpepper/craftcms/).

## Usage

First start a MySQL database for Craft:

```Shell
docker run --name database \
	-e MYSQL_ROOT_PASSWORD=password \
	-e MYSQL_USER=craft \
	-e MYSQL_PASSWORD=password \
	-e MYSQL_DATABASE=craft \
	-d mariadb:10
```

Then run Craft:

```Shell
docker run --name craftcms \
	-e DB_SERVER=database \
	-e DB_USER=craft \
	-e DB_PASSWORD=password \
	-e DB_DATABASE=craft \
	-e DB_DRIVER=mysql \
	--link database \
	-p 8080:80 \
	-d blackpepper/craftcms
```

Visit http://localhost:8080/admin to create a site.

### Docker Compose

Alternatively use Docker Compose:

```YAML
version: '2.4'

services:

  craftcms:
    image: blackpepper/craftcms
    environment:
      DB_SERVER: database
      DB_USER: craft
      DB_PASSWORD: password
      DB_DATABASE: craft
      DB_DRIVER: mysql
    links:
      - database
    ports:
      - 8080:80

  database:
    image: mariadb:10
    environment:
      MYSQL_ROOT_PASSWORD: password
      MYSQL_USER: craft
      MYSQL_PASSWORD: password
      MYSQL_DATABASE: craft
    ports:
      - 3306:3306
```

See the [demo](demo) project to see this in action.

## Tags

The following Docker image tags are available:

Craft Version | Tag
--------------|----
3 | [`latest`](https://github.com/BlackPepperSoftware/docker-craftcms/blob/master/Dockerfile)
2 | [`2`](https://github.com/BlackPepperSoftware/docker-craftcms/blob/2/Dockerfile)

## Configuration

Use the following environment variables to configure Craft at runtime:

Variable Name | Craft Setting
--------------|--------------
`DB_DSN` | [`mysql:host=localhost;port=3306;dbname=craft`](https://docs.craftcms.com/v3/config/db-settings.html#dsn)
`DB_USER` | [`user`](https://docs.craftcms.com/v3/config/db-settings.html#user)
`DB_PASSWORD` | [`password`](https://docs.craftcms.com/v3/config/db-settings.html#password)
`CRAFT_ALLOW_UPDATES` | [`allowUpdates`](https://docs.craftcms.com/v3/config/config-settings.html#allowupdates)
`CRAFT_COOLDOWN_DURATION` | [`cooldownDuration`](https://docs.craftcms.com/v3/config/config-settings.html#cooldownduration)
`CRAFT_DEV_MODE` | [`devMode`](https://docs.craftcms.com/v3/config/config-settings.html#devmode)
`CRAFT_ENABLE_TEMPLATE_CACHING` | [`enableTemplateCaching`](https://docs.craftcms.com/v3/config/config-settings.html#enabletemplatecaching)
`CRAFT_MAX_UPLOAD_FILE_SIZE` | [`maxUploadFileSize`](https://docs.craftcms.com/v3/config/config-settings.html#maxuploadfilesize)
`CRAFT_OMIT_SCRIPT_NAME_IN_URLS` | [`omitScriptNameInUrls`](https://docs.craftcms.com/v3/config/config-settings.html#omitscriptnameinurls)
`CRAFT_PHP_MAX_MEMORY_LIMIT` | [`phpMaxMemoryLimit`](https://docs.craftcms.com/v3/config/config-settings.html#phpmaxmemorylimit)
`CRAFT_SITE_URL` | [`siteUrl`](https://docs.craftcms.com/v3/config/config-settings.html#siteurl)
`CRAFT_TRANSFORM_GIFS` | [`transformGifs`](https://docs.craftcms.com/v3/config/config-settings.html#transformgifs)
`CRAFT_USE_COMPRESSED_JS` | [`useCompressedJs`](https://docs.craftcms.com/v3/config/config-settings.html#usecompressedjs)
`CRAFT_USER_SESSION_DURATION` | [`userSessionDuration`](https://docs.craftcms.com/v3/config/config-settings.html#usersessionduration)

## Customisation

Use as a base image to customise Craft templates and public assets:

```Dockerfile
FROM blackpepper/craftcms

COPY public /var/www/web
COPY templates /var/www/templates
```

## Version

This image aspires to track the latest build of Craft CMS 3.0. Use the following build arguments to customise the Craft CMS version at build time:

Argument        | Description
----------------|----------------------------------------
`CMS_VERSION`   | The version number of craft cms to use, including the major, minor and build numbers, e.g. `3.6.5.1`
`CRAFT_VERSION` | The version of the craft installer project to use, including the major, minor and build numbers, e.g. `1.1.2`

For example, to build an image for Craft CMS version 3.0.18:

```Shell
docker build --build-arg CMS_VERSION=3.6.5.1 --build-arg CRAFT_VERSION=1.1.2 .
```
