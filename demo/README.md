# docker-craftcms demo

This project demonstrates how to use `blackpepper/craftcms` with Docker Compose to run and customise Craft CMS.

## Running

1. `docker-compose up`
1. Visit http://localhost:8080/admin
1. [Run the Craft installer](https://craftcms.com/docs/installing#step-5-run-the-installer)
1. View the site at http://localhost:8080/

## Customisations

The site's `Dockerfile` overlays the following directories on top of the standard Craft installation:

* `public` — web assets
* `templates` — Craft site templates

In this demonstration we add a `public/newspaper.png` web asset and reference it from the `templates/index.html` index
template. You can see this image by visiting the site at http://localhost:8080/.