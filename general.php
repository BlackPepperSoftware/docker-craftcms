<?php

/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here.
 * You can see a list of the default settings in craft/app/etc/config/defaults/general.php
 */

$allowUpdates = getenv('CRAFT_ALLOW_UPDATES');
$cooldownDuration = getenv('CRAFT_COOLDOWN_DURATION');
$omitScriptNameInUrls = getenv('CRAFT_OMIT_SCRIPT_NAME_IN_URLS');
$siteUrl = getenv('CRAFT_SITE_URL');
$userSessionDuration = getenv('CRAFT_USER_SESSION_DURATION');

return [
    // Global settings
    '*' => [
        'allowUpdates' => ($allowUpdates === 'minor-only' || $allowUpdates === 'build-only')
            ? $allowUpdates
            : ($allowUpdates === 'true'),

        'cooldownDuration' => ($cooldownDuration === 'false') ? false : $cooldownDuration,

        'cpTrigger' => 'admin',

        'defaultWeekStartDay' => 0,

        'devMode' => getenv('CRAFT_DEV_MODE') === 'true',

        'enableCsrfProtection' => true,

        'maxUploadFileSize' => getenv('CRAFT_MAX_UPLOAD_FILE_SIZE'),

        'omitScriptNameInUrls' => ($omitScriptNameInUrls === 'auto')
            ? $omitScriptNameInUrls
            : ($omitScriptNameInUrls === 'true'),

        'siteUrl' => $siteUrl ? $siteUrl : null,

        'useCompressedJs' => getenv('CRAFT_USE_COMPRESSED_JS') === 'true',

        'userSessionDuration' => ($userSessionDuration === 'false') ? false : $userSessionDuration
    ]
];
