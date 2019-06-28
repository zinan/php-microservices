<?php
/**
 * This file is part of order_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  OrderManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */

error_reporting(E_ERROR | E_PARSE);

require_once __DIR__.'/../vendor/autoload.php';

Sentry\init(['dsn' => 'https://8c9d7d4e841c421482d60533dc100833@sentry.io/1491710' ]);

$app = new OrderManagement\Application();

$app->run();
