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

	// Whether or not to allow auto-updating in Craft
	'allowAutoUpdates' => ($allowAutoUpdates === 'minor-only' || $allowAutoUpdates === 'build-only')
		? $allowAutoUpdates
		: ($allowAutoUpdates === 'true'),

	// Control Panel trigger word
	'cpTrigger' => 'admin',

	// Default Week Start Day (0 = Sunday, 1 = Monday...)
	'defaultWeekStartDay' => 0,

	// Determines whether the system is in Dev Mode or not
	'devMode' => getenv('CRAFT_DEV_MODE') === 'true',

	// Enable CSRF Protection (recommended, will be enabled by default in Craft 3)
	'enableCsrfProtection' => true,

	// Environment-specific variables (see https://craftcms.com/docs/multi-environment-configs#environment-specific-variables)
	'environmentVariables' => array(),

	// Whether "index.php" should be visible in URLs (true, false, "auto")
	'omitScriptNameInUrls' => ($omitScriptNameInUrls === 'auto')
		? $omitScriptNameInUrls
		: ($omitScriptNameInUrls === 'true'),

	// Base site URL
	'siteUrl' => null,

	// Tells Craft whether to use compressed Javascript files whenever possible
	'useCompressedJs' => getenv('CRAFT_USE_COMPRESSED_JS') === 'true',

);
