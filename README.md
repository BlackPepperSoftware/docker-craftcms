# docker-craftcms

Docker image for [Craft CMS](https://craftcms.com/). Available on Docker Hub as [blackpepper/craftcms](https://hub.docker.com/r/blackpepper/craftcms/).

## Usage

First start a MySQL database for Craft:

```
docker run --name database \
	-e MYSQL_ROOT_PASSWORD=password \
	-e MYSQL_USER=craft \
	-e MYSQL_PASSWORD=password \
	-e MYSQL_DATABASE=craft \
	-d mariadb:10
```

Then run Craft:

```
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
