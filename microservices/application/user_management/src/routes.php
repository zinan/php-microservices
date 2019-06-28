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

use Slim\Http\Request;
use Slim\Http\Response;
use UserManagement\Controllers\LoginController;
use UserManagement\Controllers\RegisterController;

$app->group(/**
 *
 */
    '/user',
    function () {
        $jwtMiddleware = $this->getContainer()->get('jwt');
        $this->post('/login', LoginController::class.':login')->setName('auth.login');
        $this->get('/get', LoginController::class.':getUser')->setName('auth.get');
        $this->get('/logout', LoginController::class.':logout')->add($jwtMiddleware)->setName('auth.logout');
        $this->get('/checkToken', LoginController::class.':checkToken')->add($jwtMiddleware)->setName('auth.checkToken');
        $this->post('/register', RegisterController::class.':register')->setName('auth.register');
});


$app->get(/**
 * @param Request $request
 * @param Response $response
 * @return mixed
 */
    '/',
    function(Request $request, Response $response) use ($app) {
    return $this->renderer->render($response, 'index.phtml');
    });

$app->get(/**
 * @return mixed
 */
    '/ping',
    function() use ($app) {
    return $this->response->write('pong');
    });
