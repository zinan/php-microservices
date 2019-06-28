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

/**
 * Class UserTestCase
 * @package Tests
 */
class UserTestCase extends BaseTestCase
{
    /**
     * Test that the index route returns http 200
     */
    public function testBaseRoute() {
        $response = $this->runApp('GET', '/');
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test that the login route returns http 200 and token has a value
     */
    public function testUserLoginSuccess() {
        $response = $this->runApp('POST', '/user/login', ['user'=>['username'=>'admin','password'=>'123123']]);
        $result = json_decode($response->getBody(), true);
        $this->assertNotNull($result['user']['token']);
        $this->assertSame($response->getStatusCode(), 200);
    }

    /**
     * Test that the login route returns http 422 and token is null when wrong user info
     */
    public function testUserLoginFailure() {
        $response = $this->runApp('POST', '/user/login', ['user'=>['username'=>'adminx','password'=>'11111']]);
        $result = json_decode($response->getBody(), true);
        $this->assertFalse(isset($result['user']['token']));
        $this->assertSame($response->getStatusCode(), 422);
    }

}