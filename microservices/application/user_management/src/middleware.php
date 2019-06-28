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
use RKA\Middleware\IpAddress;
use Illuminate\Database\Capsule\Manager as DB;

$app->add(/**
 * @param Request $request
 * @param Response $response
 * @param callable $next
 * @return Response
 */
    function (Request $request, Response $response, callable $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();
    if ($path != '/' && substr($path, -1) == '/') {
        $uri = $uri->withPath(substr($path, 0, -1));
        if ($request->getMethod() == 'GET') {
            return $response->withRedirect((string)$uri, 301);
        } else {
            return $next($request->withUri($uri), $response);
        }
    }
    return $next($request, $response);
});
$app->add(/**
 * @param $req
 * @param $res
 * @param $next
 * @return mixed
 */
    function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
        ->withHeader('Access-Control-Allow-Origin', $this->get('settings')['cors'])
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


$checkProxyHeaders = true;
$trustedProxies = [];
$app->add(new IpAddress($checkProxyHeaders, $trustedProxies));




