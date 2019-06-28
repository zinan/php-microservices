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

namespace Tests;

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use PHPUnit\Framework\TestCase;

/**
 * Class BaseTestCase
 * @package Tests
 */
class BaseTestCase extends TestCase
{

    /**
     * @param $requestMethod
     * @param $requestUri
     * @param null $requestData
     * @return \Psr\Http\Message\ResponseInterface|Response
     * @throws \Slim\Exception\MethodNotAllowedException
     * @throws \Slim\Exception\NotFoundException
     */
    public function runApp($requestMethod, $requestUri, $requestData = null)
    {
        $environment = Environment::mock(
            [
                'REQUEST_METHOD' => $requestMethod,
                'REQUEST_URI' => $requestUri
            ]
        );
        $request = Request::createFromEnvironment($environment);
        if (isset($requestData)) {
            $request = $request->withParsedBody($requestData);
        }
        $response = new Response();
        $settings = require __DIR__ . '/../src/settings.php';
        $app = new App($settings);
        require __DIR__ . '/../src/dependencies.php';
        require __DIR__ . '/../src/middleware.php';
        require __DIR__ . '/../src/routes.php';
        $response = $app->process($request, $response);
        return $response;
    }

}