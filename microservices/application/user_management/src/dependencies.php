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

use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;

$container = $app->getContainer();

$container->register(new \UserManagement\Services\Database\EloquentServiceProvider());
$container->register(new \UserManagement\Services\Auth\AuthServiceProvider());
/**
 * @param $c
 * @return \Slim\Views\PhpRenderer
 */
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

/**
 * @param $c
 * @return \Slim\Middleware\JwtAuthentication
 */
$container['jwt'] = function ($c) {
    $jws_settings = $c->get('settings')['jwt'];
    return new \Slim\Middleware\JwtAuthentication($jws_settings);
};
/**
 * @param $c
 * @return \UserManagement\Validation\Validator
 */
$container['validator'] = function ($c) {
    \Respect\Validation\Validator::with('\\UserManagement\\Validation\\Rules');
    return new \UserManagement\Validation\Validator();
};
/**
 * @param $c
 * @return Manager
 */
$container['fractal'] = function ($c) {
    $manager = new Manager();
    $manager->setSerializer(new ArraySerializer());
    return $manager;
};
/**
 * @param $c
 * @return mixed
 */
$container['appSettings'] = function ($c) {
    return $c->get('settings')['app'];
};

