<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see craft\config\GeneralConfig
 */

$cooldownDuration = getenv('CRAFT_COOLDOWN_DURATION');
$userSessionDuration = getenv('CRAFT_USER_SESSION_DURATION');

return [
    // Global settings
    '*' => [
        'allowUpdates' => getenv('CRAFT_ALLOW_UPDATES'),

        'cooldownDuration' => ($cooldownDuration === 'false') ? false : $cooldownDuration,

        // Control Panel trigger word
        'cpTrigger' => 'admin',

        // Default Week Start Day (0 = Sunday, 1 = Monday...)
        'defaultWeekStartDay' => 0,

        // Dev Mode (see https://craftcms.com/support/dev-mode)
        'devMode' => getenv('CRAFT_DEV_MODE') === 'true',

        // Enable CSRF Protection (recommended)
        'enableCsrfProtection' => true,

        'maxUploadFileSize' => getenv('CRAFT_MAX_UPLOAD_FILE_SIZE'),

        // Whether generated URLs should omit "index.php"
        'omitScriptNameInUrls' => getenv('CRAFT_OMIT_SCRIPT_NAME_IN_URLS') === 'true',

        // The secure key Craft will use for hashing and encrypting data
        'securityKey' => getenv('SECURITY_KEY'),

        // Base site URL
        'siteUrl' => getenv('CRAFT_SITE_URL') ?: null,

        'useCompressedJs' => getenv('CRAFT_USE_COMPRESSED_JS') === 'true',

        'userSessionDuration' => ($userSessionDuration === 'false') ? false : $userSessionDuration
    ],
];
