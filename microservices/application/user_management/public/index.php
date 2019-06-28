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

ini_set('date.timezone', 'Europe/Istanbul');
require __DIR__ . '/../vendor/autoload.php';
session_start();
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);
require __DIR__ . '/../src/dependencies.php';
require __DIR__ . '/../src/middleware.php';
require __DIR__ . '/../src/routes.php';

Sentry\init(['dsn' => 'https://8c9d7d4e841c421482d60533dc100833@sentry.io/1491710' ]);

$app->run();

