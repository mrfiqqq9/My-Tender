<?php
declare(strict_types=1);

use Cake\Cache\Engine\FileEngine;
use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;
use Cake\Log\Engine\FileLog;
use Cake\Mailer\Transport\MailTransport;

return [

    /*
     * DEBUG
     */
    'debug' => true,

    /*
     * APP
     */
    'App' => [
        'namespace' => 'App',
        'encoding' => 'UTF-8',
        'defaultLocale' => 'en_US',
        'defaultTimezone' => 'UTC',

        // SUBFOLDER
        'base' => '/my-tender',

        'dir' => 'src',
        'webroot' => 'webroot',
        'wwwRoot' => WWW_ROOT,
        'fullBaseUrl' => false,

        'paths' => [
            'plugins' => [ROOT . DS . 'plugins' . DS],
            'templates' => [ROOT . DS . 'templates' . DS],
        ],
    ],

    /*
     * SECURITY
     */
    'Security' => [
        'salt' => 'my-tender-secret-salt-change-this-now',
    ],

    /*
     * CACHE (🔥 WAJIB ADA SEMUA INI)
     */
    'Cache' => [

    'default' => [
        'className' => FileEngine::class,
        'path' => CACHE,
    ],

    '_cake_translations_' => [
        'className' => FileEngine::class,
        'path' => CACHE . 'persistent' . DS,
        'prefix' => 'cake_translations_',
        'serialize' => true,
        'duration' => '+1 day',
    ],

    '_cake_model_' => [
        'className' => FileEngine::class,
        'path' => CACHE . 'models' . DS,
        'prefix' => 'cake_model_',
        'serialize' => true,
        'duration' => '+1 day',
    ],
],


    /*
     * DATABASE
     */
    'Datasources' => [
        'default' => [
            'className' => Connection::class,
            'driver' => Mysql::class,
            'host' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'my-tender',
            'encoding' => 'utf8mb4',
            'timezone' => 'UTC',
            'cacheMetadata' => true,
            'quoteIdentifiers' => false,
        ],
    ],

    /*
     * LOGGING
     */
    'Log' => [
        'debug' => [
            'className' => FileLog::class,
            'path' => LOGS,
            'file' => 'debug',
            'levels' => ['notice', 'info', 'debug'],
        ],
        'error' => [
            'className' => FileLog::class,
            'path' => LOGS,
            'file' => 'error',
            'levels' => ['warning', 'error', 'critical'],
        ],
    ],

    /*
     * SESSION
     */
    'Session' => [
    'defaults' => 'php',
    'cookiePath' => '/my-tender',
    ],

    /*
     * EMAIL
     */
    'EmailTransport' => [
        'default' => [
            'className' => MailTransport::class,
        ],
    ],
];
