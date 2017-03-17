<?php

/**
 * Database Configuration
 *
 * All of your system's database configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/db.php
 */

return array(

	'server' => getenv('CRAFT_DATABASE_HOST'),

	'port' => getenv('CRAFT_DATABASE_PORT'),

	'database' => getenv('CRAFT_DATABASE_NAME'),

	'user' => getenv('CRAFT_DATABASE_USER'),

	'password' => getenv('CRAFT_DATABASE_PASSWORD'),

	'tablePrefix' => 'craft',

);
