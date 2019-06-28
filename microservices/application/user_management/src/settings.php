<?php
/**
 * This file is part of user_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  UserManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */

/**
 *
 */
defined('DS') ?: define('DS', DIRECTORY_SEPARATOR);
/**
 *
 */
defined('ROOT') ?: define('ROOT', dirname(__DIR__) . DS);

if (file_exists(ROOT . '.env')) {
    $dotenv = new Dotenv\Dotenv(ROOT);
    $dotenv->load();
}

return [
    'settings' => [
        'displayErrorDetails'    => getenv('APP_DEBUG') === 'true' ? true : false,
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => true,

        'app'                    => [
            'name'      => getenv('APP_NAME'),
            'url'       => getenv('APP_URL'),
            'env'       => getenv('APP_ENV'),
            'version'   => getenv('APP_VERSION'),
            'contact_email'   => getenv('APP_CONTACT_EMAIL'),
            'session_expire'   => getenv('SESSION_EXPIRE_MINUTES')
        ],

        'renderer'               => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        'database'               => [
            'driver'    => getenv('DB_CONNECTION'),
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_DATABASE'),
            'username'  => getenv('DB_USERNAME'),
            'password'  => getenv('DB_PASSWORD'),
            'port'      => getenv('DB_PORT'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        'cors' => null !== getenv('CORS_ALLOWED_ORIGINS') ? getenv('CORS_ALLOWED_ORIGINS') : '*',

        'jwt'  => [
            'secret' => getenv('JWT_SECRET'),
            'secure' => false,
            "header" => "Authorization",
            "regexp" => "/Bearer\s+(.*)$/i",
            'passthrough' => ['OPTIONS']
        ]

    ],
];
