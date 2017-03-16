<?php

/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/general.php
 */

$allowAutoUpdates = getenv('CRAFT_ALLOW_AUTO_UPDATES');
$omitScriptNameInUrls = getenv('CRAFT_OMIT_SCRIPT_NAME_IN_URLS');

return array(

	'allowAutoUpdates' => ($allowAutoUpdates === 'minor-only' || $allowAutoUpdates === 'build-only')
		? $allowAutoUpdates
		: ($allowAutoUpdates === 'true'),

	'cpTrigger' => 'admin',

	'defaultWeekStartDay' => 0,

	'devMode' => getenv('CRAFT_DEV_MODE') === 'true',

	'enableCsrfProtection' => true,

	'environmentVariables' => array(),

	'omitScriptNameInUrls' => ($omitScriptNameInUrls === 'auto')
		? $omitScriptNameInUrls
		: ($omitScriptNameInUrls === 'true'),

	'siteUrl' => null,

	'useCompressedJs' => getenv('CRAFT_USE_COMPRESSED_JS') === 'true',

);
