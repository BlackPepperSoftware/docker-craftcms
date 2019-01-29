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
    - "8080:80"

database:
  image: mariadb:10
  environment:
    MYSQL_ROOT_PASSWORD: password
    MYSQL_USER: craft
    MYSQL_PASSWORD: password
    MYSQL_DATABASE: craft
  ports:
    - "3306:3306"
```

See the [demo](demo) project to see this in action.

## Configuration

Use the following environment variables to configure Craft at runtime:

Variable Name | Craft Setting
--------------|--------------
`DB_DRIVER` | [`driver`](https://docs.craftcms.com/v3/config/db-settings.html#driver)
`DB_SERVER` | [`server`](https://docs.craftcms.com/v3/config/db-settings.html#server)
`DB_PORT` | [`port`](https://docs.craftcms.com/v3/config/db-settings.html#port)
`DB_DATABASE` | [`database`](https://docs.craftcms.com/v3/config/db-settings.html#database)
`DB_USER` | [`user`](https://docs.craftcms.com/v3/config/db-settings.html#user)
`DB_PASSWORD` | [`password`](https://docs.craftcms.com/v3/config/db-settings.html#password)
`CRAFT_ALLOW_UPDATES` | [`allowUpdates`](https://docs.craftcms.com/v3/config/config-settings.html#allowupdates)
`CRAFT_COOLDOWN_DURATION` | [`cooldownDuration`](https://docs.craftcms.com/v3/config/config-settings.html#cooldownduration)
`CRAFT_DEV_MODE` | [`devMode`](https://docs.craftcms.com/v3/config/config-settings.html#devmode)
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
FROM blackpepper/craftcms:craft3

COPY public /var/www/web
COPY templates /var/www/templates
```

## Version

This image aspires to track the latest build of Craft CMS 3.0. Use the following build arguments to customise the Craft CMS version at build time:

Argument        | Description
----------------|----------------------------------------
`CRAFT_VERSION` | The major and minor version, e.g. `3.0`
`CRAFT_BUILD`   | The build number, e.g. `18`

For example, to build an image for Craft CMS version 3.0.18:

```Shell
docker build --build-arg CRAFT_VERSION=3.0 --build-arg CRAFT_BUILD=18.
```
