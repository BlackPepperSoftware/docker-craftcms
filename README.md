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
	-e CRAFT_DATABASE_HOST=database \
	-e CRAFT_DATABASE_USER=craft \
	-e CRAFT_DATABASE_PASSWORD=password \
	-e CRAFT_DATABASE_NAME=craft \
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
    CRAFT_DATABASE_HOST: database
    CRAFT_DATABASE_USER: craft
    CRAFT_DATABASE_PASSWORD: password
    CRAFT_DATABASE_NAME: craft
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

## Configuration

Use the following environment variables to configure Craft at runtime:

Section | Variable Name | Craft Setting
--------|---------------|--------------
Database | `CRAFT_DATABASE_HOST` | [`server`](https://craftcms.com/docs/installing#step-4-tell-craft-how-to-connect-to-your-database)
| | `CRAFT_DATABASE_PORT` | [`port`](https://craftcms.com/docs/installing#step-4-tell-craft-how-to-connect-to-your-database)
| | `CRAFT_DATABASE_USER` | [`user`](https://craftcms.com/docs/installing#step-4-tell-craft-how-to-connect-to-your-database)
| | `CRAFT_DATABASE_PASSWORD` | [`password`](https://craftcms.com/docs/installing#step-4-tell-craft-how-to-connect-to-your-database)
| | `CRAFT_DATABASE_NAME` | [`database`](https://craftcms.com/docs/installing#step-4-tell-craft-how-to-connect-to-your-database)
General | `CRAFT_DEV_MODE` | [`devMode`](https://craftcms.com/docs/config-settings#devMode)
| | `CRAFT_SITE_URL` | [`siteUrl`](https://craftcms.com/docs/config-settings#siteUrl)
| | `CRAFT_USE_COMPRESSED_JS` | [`useCompressedJs`](https://craftcms.com/docs/config-settings#useCompressedJs)
Updates | `CRAFT_ALLOW_AUTO_UPDATES` | [`allowAutoUpdates`](https://craftcms.com/docs/config-settings#allowAutoUpdates)
URLs | `CRAFT_OMIT_SCRIPT_NAME_IN_URLS` | [`omitScriptNameInUrls`](https://craftcms.com/docs/config-settings#omitScriptNameInUrls)
Users | `CRAFT_COOLDOWN_DURATION` | [`cooldownDuration`](https://craftcms.com/docs/config-settings#cooldownDuration)
| | `CRAFT_USER_SESSION_DURATION` | [`userSessionDuration`](https://craftcms.com/docs/config-settings#userSessionDuration)
Assets | `CRAFT_MAX_UPLOAD_FILE_SIZE` | [`maxUploadFileSize`](https://craftcms.com/docs/config-settings#maxUploadFileSize)

## Customisation

Use as a base image to customise Craft templates and public assets:

```Dockerfile
FROM blackpepper/craftcms

ADD templates /var/www/craft/templates
ADD public /var/www/html
```

Put [Craft files](https://craftcms.com/docs/folder-structure) under `/var/www/craft` and
[public assets](https://craftcms.com/docs/installing#step-1-upload-the-files) under `/var/www/html`.
