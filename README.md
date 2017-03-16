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

Name | Craft Setting | Description
-----|---------------|------------
`CRAFT_DATABASE_HOST` | [server](https://craftcms.com/docs/installing#step-4-tell-craft-how-to-connect-to-your-database) | The database server name or IP address
`CRAFT_DATABASE_USER` | [user](https://craftcms.com/docs/installing#step-4-tell-craft-how-to-connect-to-your-database) | The database username to connect with
`CRAFT_DATABASE_PASSWORD` | [password](https://craftcms.com/docs/installing#step-4-tell-craft-how-to-connect-to-your-database) | The database password to connect with
`CRAFT_DATABASE_NAME` | [database](https://craftcms.com/docs/installing#step-4-tell-craft-how-to-connect-to-your-database) | The name of the database to select
`CRAFT_OMIT_SCRIPT_NAME_IN_URLS` | [omitScriptNameInUrls](https://craftcms.com/docs/config-settings#omitScriptNameInUrls) | Whether "index.php" should be visible in URLs

## Customisation

Use as a base image to customise Craft templates and public assets:

```Dockerfile
FROM blackpepper/craftcms

ADD public /var/www/html
ADD templates /var/www/craft/templates
```

Put [Craft files](https://craftcms.com/docs/folder-structure) under `/var/www/craft` and
[public assets](https://craftcms.com/docs/installing#step-1-upload-the-files) under `/var/www/html`.
