<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see craft\config\GeneralConfig
 */

return [
    // Global settings
    '*' => [
        'allowUpdates' => (getenv('CRAFT_ALLOW_UPDATES') ?: 'true') === 'true',

        'cooldownDuration' => (int) (getenv('CRAFT_COOLDOWN_DURATION') ?: '300'),

        // Control Panel trigger word
        'cpTrigger' => 'admin',

        // Default Week Start Day (0 = Sunday, 1 = Monday...)
        'defaultWeekStartDay' => 0,

        // Dev Mode (see https://craftcms.com/support/dev-mode)
        'devMode' => (getenv('CRAFT_DEV_MODE') ?: 'true') === 'true',

        // Enable CSRF Protection (recommended)
        'enableCsrfProtection' => true,

	'enableTemplateCaching' => (getenv('CRAFT_ENABLE_TEMPLATE_CACHING') ?: 'true') === 'true',

        'maxUploadFileSize' => (int) (getenv('CRAFT_MAX_UPLOAD_FILE_SIZE') ?: '16777216'),

        // Whether generated URLs should omit "index.php"
        'omitScriptNameInUrls' => (getenv('CRAFT_OMIT_SCRIPT_NAME_IN_URLS') ?: 'false') === 'true',

        'phpMaxMemoryLimit' => getenv('CRAFT_PHP_MAX_MEMORY_LIMIT') ?: '',

        // The secure key Craft will use for hashing and encrypting data
        'securityKey' => getenv('SECURITY_KEY'),

        // Base site URL
        'siteUrl' => getenv('CRAFT_SITE_URL') ?: null,

        'transformGifs' => (getenv('CRAFT_TRANSFORM_GIFS') ?: 'true') === 'true',

        'useCompressedJs' => (getenv('CRAFT_USE_COMPRESSED_JS') ?: 'true') === 'true',

        'userSessionDuration' => (int) (getenv('CRAFT_USER_SESSION_DURATION') ?: '3600')
    ],
];
